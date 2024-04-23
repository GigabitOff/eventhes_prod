<?php

namespace App\Http\Controllers\Admin;


use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class AdminOrderController extends Controller
{
    public function index()
    {
        $admins = User::where('role_id', 1)->get();
        $currentAdmin = auth()->user();
        if ($currentAdmin->role_id == 1) {
            $orders = Order::where('user_id', $currentAdmin->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif ($currentAdmin->role_id == 3 or $currentAdmin->role_id == 2) {
            $eventIds = Event::where('user_id', $currentAdmin->id)->pluck('id');
            $orders = Order::whereIn('event_id', $eventIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('admin.orders.index', compact('currentAdmin','admins', 'orders'));
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.orders.create',compact('currentAdmin','admins'));
    }

    public function statistic()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.orders.statistic', compact('currentAdmin','admins'));
    }


        public function store(Request $request)
    {
        $user = Auth::user();
        // Получаем данные из запроса
        $date = $request->input('date');
        $quantity = $request->input('quantity');


        // Обрабатываем данные (например, сохраняем их в базу данных)

        return response()->json(['message' => 'Данные успешно получены и обработаны'], 200);
    }


}
