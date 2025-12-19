@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">🧾 Thanh toán COD</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- FORM -->
    <div class="bg-white p-6 rounded shadow">
        <form method="POST" action="/checkout">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Họ tên</label>
                <input type="text" name="customer_name"
                       value="{{ auth()->user()->name }}"
                       class="border w-full p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Số điện thoại</label>
                <input type="text" name="customer_phone"
                       class="border w-full p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Địa chỉ giao hàng</label>
                <textarea name="customer_address"
                          class="border w-full p-2 rounded"></textarea>
            </div>

            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p>💵 Hình thức thanh toán:</p>
                <strong>Thanh toán khi nhận hàng (COD)</strong>
            </div>

            <button
                class="w-full bg-indigo-600 text-white py-3 rounded hover:bg-indigo-700">
                Xác nhận đặt hàng
            </button>
        </form>
    </div>

    <!-- TÓM TẮT -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-4">Đơn hàng của bạn</h2>

        @foreach($cart as $item)
            <div class="flex justify-between mb-2">
                <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                <span>{{ number_format($item['price'] * $item['quantity']) }}đ</span>
            </div>
        @endforeach

        <hr class="my-4">

        <div class="flex justify-between font-bold text-lg">
            <span>Tổng cộng</span>
            <span class="text-red-600">{{ number_format($total) }}đ</span>
        </div>
    </div>

</div>

@endsection
