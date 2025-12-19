@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">📦 Đơn hàng của tôi</h1>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead class="border-b">
            <tr>
                <th class="p-3 text-left">Mã đơn</th>
                <th class="p-3 text-center">Tổng tiền</th>
                <th class="p-3 text-center">Trạng thái</th>
                <th class="p-3 text-center">Ngày đặt</th>
                <th class="p-3 text-center">Chi tiết</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
                <tr class="border-b">
                    <td class="p-3">#{{ $order->id }}</td>
                    <td class="p-3 text-center">
                        {{ number_format($order->total_price) }}đ
                    </td>
                    <td class="p-3 text-center font-semibold">
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
</td>
                    <!-- NGÀY ĐẶT -->
                    <td class="p-3 text-center">
                        {{ $order->created_at->format('d/m/Y') }}
                    </td>
                     <!-- CHI TIẾT -->
    <td class="p-3 text-center">
        <a href="{{ route('orders.show', $order->id) }}"
           class="px-4 py-1.5 bg-blue-600 text-white items-center gap-1 hover:bg-blue-800">Xem chi tiết
        </a>
    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
