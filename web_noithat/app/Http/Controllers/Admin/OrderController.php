<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 🔹 Danh sách đơn hàng
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // 🔹 Xem chi tiết đơn hàng
    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    // 🔹 Cập nhật trạng thái
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng');
    }

    // 🔹 Hủy đơn
    public function destroy(Order $order)
    {
        $order->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Đã hủy đơn hàng');
    }
}
