@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">🛒 Giỏ hàng của bạn</h1>

@if(empty($cart))
    <div class="bg-white p-6 rounded shadow text-center">
        <p class="text-gray-500 mb-4">Giỏ hàng đang trống</p>
        <a href="/products"
           class="bg-indigo-600 text-white px-6 py-2 rounded">
            Tiếp tục mua sắm
        </a>
    </div>
@else

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    <!-- DANH SÁCH SẢN PHẨM -->
    <div class="md:col-span-2 bg-white rounded shadow p-6">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left pb-3">Sản phẩm</th>
                    <th class="text-center pb-3">Giá</th>
                    <th class="text-center pb-3">Số lượng</th>
                    <th class="text-center pb-3">Thành tiền</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
@foreach($cart as $id => $item)
<tr class="border-b align-middle">

    <!-- SẢN PHẨM -->
    <td class="py-4 flex items-center gap-4">
        <img src="{{ $item['image'] }}"
             class="w-16 h-16 object-cover rounded">
        <span class="font-medium">
            {{ $item['name'] }}
        </span>
    </td>

    <!-- GIÁ -->
    <td class="text-center">
        {{ number_format($item['price']) }}đ
    </td>

    <!-- SỐ LƯỢNG -->
    <td class="text-center">
        <div class="flex items-center justify-center gap-2">

            <!-- GIẢM -->
            <form method="POST" action="{{ route('cart.update') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <input type="hidden" name="action" value="decrease">
                <button
                    class="w-8 h-8 border rounded hover:bg-gray-200 text-lg font-bold">
                    −
                </button>
            </form>

            <!-- HIỂN THỊ SỐ -->
            <span class="w-8 text-center font-semibold">
                {{ $item['quantity'] }}
            </span>

            <!-- TĂNG -->
            <form method="POST" action="{{ route('cart.update') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <input type="hidden" name="action" value="increase">
                <button
                    class="w-8 h-8 border rounded hover:bg-gray-200 text-lg font-bold">
                    +
                </button>
            </form>

        </div>
    </td>

    <!-- THÀNH TIỀN -->
    <td class="text-center font-semibold">
        {{ number_format($item['price'] * $item['quantity']) }}đ
    </td>

    <!-- XÓA -->
    <td class="text-center">
    <button
        onclick="openDeleteModal({{ $id }})"
        class="px-4 py-1.5 bg-red-700 text-white rounded hover:bg-red-600">
        xóa
    </button>
</td>



</tr>
@endforeach
</tbody>

        </table>
    </div>

    <!-- TỔNG TIỀN -->
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Tóm tắt đơn hàng</h2>

        <div class="flex justify-between mb-3">
            <span>Tạm tính</span>
            <span>{{ number_format($total) }}đ</span>
        </div>

        <div class="flex justify-between mb-3">
            <span>Phí vận chuyển</span>
            <span>Miễn phí</span>
        </div>

        <hr class="my-4">

        <div class="flex justify-between text-lg font-bold">
            <span>Tổng cộng</span>
            <span class="text-red-600">{{ number_format($total) }}đ</span>
        </div>

        <a href="/checkout"
           class="block mt-6 bg-indigo-600 text-white text-center py-3 rounded-lg hover:bg-indigo-700">
            Tiến hành đặt hàng
        </a>
    </div>

</div>

@endif

@endsection
