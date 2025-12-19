<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng số đơn hàng
        $totalOrders = Order::count();

        // Tổng doanh thu (chỉ tính đơn hoàn thành)
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');

        // Tổng số sản phẩm
        $totalProducts = Product::count();

        // Thống kê nhanh
        $pendingOrders   = Order::where('status', 'pending')->count();
        $shippingOrders  = Order::where('status', 'shipping')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $canceledOrders  = Order::where('status', 'canceled')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'pendingOrders',
            'shippingOrders',
            'completedOrders',
            'canceledOrders'
        ));
    }
}
