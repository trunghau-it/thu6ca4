<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
    public function show($id)
{
    $order = Order::with('items.product')
        ->where('id', $id)
        ->where('user_id', Auth::id()) // bảo mật: chỉ xem đơn của mình
        ->firstOrFail();

    return view('orders.show', compact('order'));
}
}
