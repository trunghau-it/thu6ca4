@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    📦 Chi tiết đơn hàng #{{ $order->id }}
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- THÔNG TIN ĐƠN -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-4">Thông tin nhận hàng</h2>

        <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>

        <p class="mt-4">
            <strong>Trạng thái:</strong>
            @switch($order->status)
                @case('pending')
                    <span class="text-yellow-600">Chờ xác nhận</span>
                    @break
                @case('confirmed')
                    <span class="text-blue-600">Đã xác nhận</span>
                    @break
                @case('shipping')
                    <span class="text-indigo-600">Đang giao hàng</span>
                    @break
                @case('completed')
                    <span class="text-green-600">Hoàn thành</span>
                    @break
                @case('canceled')
                    <span class="text-red-600">Đã hủy</span>
                    @break
            @endswitch
        </p>

        <p class="mt-2">
            <strong>Ngày đặt:</strong>
            {{ $order->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <!-- TÓM TẮT -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-4">Thanh toán</h2>

        <p><strong>Hình thức:</strong> Thanh toán khi nhận hàng (COD)</p>

        <p class="mt-4 text-lg font-bold">
            Tổng tiền:
            <span class="text-red-600">
                {{ number_format($order->total_price) }}đ
            </span>
        </p>
    </div>

</div>

<!-- DANH SÁCH SẢN PHẨM -->
<div class="bg-white rounded shadow mt-8">
    <h2 class="font-bold p-4 border-b">Sản phẩm đã đặt</h2>

    <table class="w-full">
        <thead class="border-b">
            <tr>
                <th class="p-3 text-left">Sản phẩm</th>
                <th class="p-3 text-center">Giá</th>
                <th class="p-3 text-center">Số lượng</th>
                <th class="p-3 text-center">Thành tiền</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="p-3">
                        {{ $item->product->name ?? 'Sản phẩm đã xóa' }}
                    </td>
                    <td class="p-3 text-center">
                        {{ number_format($item->price) }}đ
                    </td>
                    <td class="p-3 text-center">
                        {{ $item->quantity }}
                    </td>
                    <td class="p-3 text-center font-semibold">
                        {{ number_format($item->price * $item->quantity) }}đ
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('orders.index') }}"
   class="inline-block mt-6 text-indigo-600 hover:underline">
    ← Quay lại danh sách đơn hàng
</a>

@endsection
