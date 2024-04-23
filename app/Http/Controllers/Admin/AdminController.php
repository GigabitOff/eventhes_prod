<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {

        $currentLocale = session('locale', config('app.locale'));
        $admins = User::where('role_id', 1)->get();
        $currentAdmin = auth()->user();
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $orderCount = Order::where('user_id', $currentAdmin->id)->count();

        $eventOrderCounts = collect([]);

        if ($currentAdmin->role_id == 1 || $currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $eventIds = Event::where('user_id', $currentAdmin->id)
                 ->where('status', 1)
                ->pluck('id');

            foreach ($eventIds as $eventId) {
                $orderCount = Order::where('order_id', $eventId)->count();
                $eventOrderCounts->push(['order_id' => $eventId, 'order_count' => $orderCount]);
            }
        }

        if ($currentAdmin->role_id == 1) {
            $withEventsAll = Statistic::all();
            $statisticsWithEventsType = collect();
        } elseif ($currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $withEventsAll = collect();
            $statisticsWithEventsType = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
                ->where('events.user_id', $currentAdmin->id)
                ->get();
        }

        $statisticsWithEvents = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
            ->where('events.user_id', $currentAdmin->id)
            ->count();
//
        $statisticsWithEventsUnic = Statistic::select('statistics.*')
            ->join('events', 'statistics.event_id', '=', 'events.id')
            ->where('events.user_id', $currentAdmin->id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('statistics as s2')
                    ->whereRaw('s2.event_id = events.id')
                    ->whereRaw('s2.ip = statistics.ip');
            })
            ->distinct()
            ->count();

        if ($currentAdmin->role_id == 1) {
            $eventIdsTu = Event::where('user_id', $currentAdmin->id)->pluck('id');
            $orders = Order::where('user_id', $currentAdmin->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $eventIds = Event::where('user_id', $currentAdmin->id)->pluck('id');
            $orders = Order::whereIn('event_id', $eventIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $newOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();
        $oldOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '<', $thirtyDaysAgo)
            ->count();

        if ($currentAdmin->role_id == 1 || $currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            return view('admin.index', compact('currentAdmin', 'eventOrderCounts', 'admins',  'currentLocale', 'orderCount', 'statisticsWithEventsType', 'withEventsAll', 'statisticsWithEventsUnic', 'statisticsWithEvents', 'newOrderCount', 'oldOrderCount', 'orders'));

        }

        return abort(403);
    }

    public function getOrdersWithStatus(Request $request)
    {
        $orders = Order::where('status', 1)->get();

        return response()->json($orders);
    }

    public function getOrderDetails($orderId)
    {
        $order = Order::findOrFail($orderId);

        return response()->json($order);
    }

    public function updateOrderStatus($orderId)
    {
        try {
            // Находим заказ по его ID
            $order = Order::findOrFail($orderId);

            // Обновляем статус заказа на 0
            $order->status = 0;
            $order->save();

            return response()->json(['message' => 'Статус заказа успешно обновлен']);
        } catch (\Exception $e) {
            // В случае ошибки возвращаем сообщение об ошибке
            return response()->json(['error' => 'Не удалось обновить статус заказа'], 500);
        }
    }




}

