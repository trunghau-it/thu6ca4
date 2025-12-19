<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Hiển thị form checkout
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('success', 'Giỏ hàng đang trống');
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        return view('checkout.index', compact('cart', 'total'));
    }

    // Xử lý đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required',
            'customer_phone'   => 'required',
            'customer_address' => 'required',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/cart');
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        // Tạo đơn hàng
        $order = Order::create([
            'user_id'          => Auth::id(),
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price'      => $total,
            'status'           => 'pending'
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price']
            ]);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect('/checkout/success')
            ->with('success', 'Đặt hàng thành công! Cảm ơn bạn.');
    }

    // Trang thành công
    public function success()
    {
        return view('checkout.success');
    }
}
