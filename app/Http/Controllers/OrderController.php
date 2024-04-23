<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->order_date = $request->date;
        $order->amount = $request->quantity;
        $order->order_id = $request->event_id;

        if (Auth::check()) {
            $user = Auth::user();
            $order->name = $user->name;
            $order->first = 'Test';
            $order->email = $user->email;
            $order->phone = $user->phone;
            $order->status = 1;
            $code = $this->generateRandomCode(7);
            $order->code = $code;

            // Если пользователь зарегистрирован, отправляем уведомление о заказе
            if ($request->reg1 == 0 || $request->reg2 == 1) {
                $this->sendOrderNotification($order,$user->email);
            }
        } else {
            // Для незарегистрированных пользователей
            $order->name = null;
            $order->first = "";
            $order->email = "";
            $order->phone = "";
            $order->status = 1;
        }

        if ($request->reg1 == 0) {
            $order->user_register = $request->reg1;
        }
        if ($request->reg2 == 1) {
            $order->user_register = $request->reg2;
        }

        $event = Event::find($request->event_id);

        if ($event) {
            $order->user_id = $event->user_id;
        }

        if ($request->reg2 == 1) {
            $order->save();
        }

        // Создание системного уведомления о новом заказе
        $alert = new Alert();
        $alert->user_id = $event->user_id;
        $alert->text = "New order has been placed.";
        $alert->save();

        return response()->json([
            'data' => 1.0
        ], 200);
    }

    private function sendOrderNotification($order,$email)

        {
            // Отправка уведомления о новом заказе по электронной почте
            Mail::raw("Your order details:\n\nOrder Date: {$order->order_date}\nAmount: {$order->amount}\nEvent ID: {$order->order_id}\nName: {$order->name}\nFirst Name: {$order->first}\nEmail: {$order->email}\nPhone: {$order->phone}\nTicket Link: http://example.com/tickets/{$order->code}", function ($message) use ($email) {
                $message->to("itsystems571@gmail.com")->subject('Your Order Details');
            });
        }

    public function store_no_reg(Request $request)
    {
        $request->validate([
            'nameReg' => 'required',
            'firstReg' => 'required',
            'emailReg' => 'required|email',
            'phoneReg' => 'required'
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $formattedDate = $date->format('d/m/Y');
        $order = new Order();
        $order->order_date = $formattedDate;
        $order->amount = $request->quantity ?? 0;
        $order->order_id = $request->event_id;
        $order->name = $request->nameReg;
        $order->first = $request->firstReg;
        $order->email = $request->emailReg;
        $order->phone = $request->phoneReg;
        $order->status = 1;
        if($request->reg1 == 0) {
            $order->user_register = $request->reg1;
        }
        if($request->reg2 == 1) {
            $order->user_register = $request->reg2;
        }

        $event = Event::find($request->event_id);

        if($event) {
            $order->user_id = $event->user_id;
        } else {
        }


        // Обработка динамических полей
        $dynamicFields = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'field_') === 0) {
                $dynamicFields[] = ['name' => $key, 'value' => $value];
            }
        }
        $order->data_create_order = json_encode($dynamicFields);

        $code = $this->generateRandomCode(7);
        $order->code = $code;

        $order->save();

        // Отправка уведомления о новом заказе по электронной почте
        Mail::raw("Your order details:\n\nOrder Date: {$request->date}\nAmount: {$request->quantity}\nEvent ID: {$request->event_id}\nName: {$request->nameReg}\nFirst Name: {$request->firstReg}\nEmail: {$request->emailReg}\nPhone: {$request->phoneReg}\nTicket Link: http://example.com/tickets/{$code}", function ($message) use ($request) {
            $message->to($request->emailReg)->subject('Your Order Details');
        });

        $alert = new Alert();
        $alert->user_id = $event->user_id;
        $alert->text = "New order has been placed.";
        $alert->save();

        // return response()->json($request->all());
        return response()->json([
            'data' => 1.0
        ], 200);
    }

  //  public function store_no_reg(Request $request)
    //{
//        dd($request->all());
//        // Проверка входных данных
//        $request->validate([
//            'nameReg' => 'required',
//            'firstReg' => 'required',
//            'emailReg' => 'required|email',
//            'phoneReg' => 'required',
//            // Можно добавить валидацию для дополнительных полей, если это необходимо
//        ]);
//
//        $order = new Order();
//        $order->order_date = $request->date;
//        $order->amount = $request->quantity;
//        $order->order_id = $request->event_id;
//        $order->name = $request->nameReg;
//        $order->first = $request->firstReg;
//        $order->email = $request->emailReg;
//        $order->phone = $request->phoneReg;
//        $order->status = 1;
//        $order->user_register = $request->reg1 ? $request->reg1 : $request->reg2;
//
//        $event = Event::find($request->event_id);
//        if ($event) {
//            $order->user_id = $event->user_id;
//        }
//
//        $code = $this->generateRandomCode(7);
//        $order->code = $code;
//
//        // Обработка дополнительных полей
//        $knownFields = ['_token', 'date', 'quantity', 'event_id', 'nameReg', 'firstReg', 'emailReg', 'phoneReg', 'reg1', 'reg2', '_method'];
//        $additionalFields = array_diff_key($request->all(), array_flip($knownFields));
//
//        $additionalFieldsFormatted = array_map(function($value, $key) {
//            return ['name' => $key, 'value' => $value];
//        }, $additionalFields, array_keys($additionalFields));
//
//        $order->data_create_order = json_encode($additionalFieldsFormatted);
//
//        $order->save();
//
//        // Отправка уведомления о новом заказе по электронной почте
//        Mail::raw("Your order details:\n\nOrder Date: {$request->date}\nAmount: {$request->quantity}\nEvent ID: {$request->event_id}\nName: {$request->nameReg}\nFirst Name: {$request->firstReg}\nEmail: {$request->emailReg}\nPhone: {$request->phoneReg}\nTicket Link: http://example.com/tickets/{$code}", function ($message) use ($request) {
//            $message->to($request->emailReg)->subject('Your Order Details');
//        });
//
//        $alert = new Alert();
//        $alert->user_id = $event ? $event->user_id : null;
//        $alert->text = "New order has been placed.";
//        $alert->save();

       // return response()->json($request->all());
   // }

    private function generateRandomCode($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

