@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📦 Quản lý đơn hàng</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm border-collapse">
    <thead class="bg-gray-50">
        <tr>
            <th class="p-4 text-left">Mã đơn</th>
            <th class="p-4 text-left">Khách hàng</th>
            <th class="p-4 text-center">SĐT</th>
            <th class="p-4 text-right">Tổng tiền</th>
            <th class="p-4 text-center">Trạng thái</th>
            <th class="p-4 text-right">Hành động</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $order)
        <tr class="border-t hover:bg-gray-50">
            <!-- MÃ ĐƠN -->
            <td class="p-4 font-semibold text-left">
                #{{ $order->id }}
            </td>

            <!-- KHÁCH HÀNG -->
            <td class="p-4 text-left">
                {{ $order->customer_name }}
            </td>

            <!-- SĐT -->
            <td class="p-4 text-center">
                {{ $order->customer_phone }}
            </td>

            <!-- TỔNG TIỀN -->
            <td class="p-4 text-right font-medium">
                {{ number_format($order->total_price) }}đ
            </td>

            <!-- TRẠNG THÁI -->
            <td class="p-4 text-center">
                <span class="px-3 py-1 text-xs rounded-full
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                    @elseif($order->status == 'confirmed') bg-blue-100 text-blue-700
                    @elseif($order->status == 'shipping') bg-indigo-100 text-indigo-700
                    @elseif($order->status == 'completed') bg-green-100 text-green-700
                    @else bg-red-100 text-red-700 @endif">
                    {{ $order->status_text }}
                </span>
            </td>

            <!-- HÀNH ĐỘNG -->
            <td class="p-4 text-right">
                <a href="{{ route('admin.orders.show', $order) }}"
                   class="text-indigo-600 hover:underline font-medium">
                    Xem
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
