<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    // Thêm sản phẩm
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'quantity' => 1,
                'image' => $product->thumbnail
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    // Cập nhật số lượng
    public function update(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->product_id;

    if (isset($cart[$id])) {
        if ($request->action == 'increase') {
            $cart[$id]['quantity']++;
        }

        if ($request->action == 'decrease') {
            $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
        }

        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index');
}


    // Xóa sản phẩm
    public function remove(Request $request)
{
    $cart = session()->get('cart', []);
    $productId = $request->product_id;

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    return redirect()
        ->route('cart.index')
        ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
}

}
