@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">📊 Admin Dashboard</h1>

<!-- THỐNG KÊ TỔNG -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-500">Tổng đơn hàng</p>
        <p class="text-3xl font-bold mt-2">
            {{ $totalOrders }}
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-500">Tổng doanh thu</p>
        <p class="text-3xl font-bold mt-2 text-green-600">
            {{ number_format($totalRevenue) }}đ
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-500">Tổng sản phẩm</p>
        <p class="text-3xl font-bold mt-2">
            {{ $totalProducts }}
        </p>
    </div>

</div>

<!-- THỐNG KÊ NHANH -->
<div class="bg-white rounded shadow p-6">
    <h2 class="text-lg font-bold mb-4">📌 Thống kê nhanh đơn hàng</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="p-4 bg-yellow-100 rounded text-center">
            <p class="text-gray-600">Chờ xác nhận</p>
            <p class="text-2xl font-bold text-yellow-700">
                {{ $pendingOrders }}
            </p>
        </div>

        <div class="p-4 bg-indigo-100 rounded text-center">
            <p class="text-gray-600">Đang giao</p>
            <p class="text-2xl font-bold text-indigo-700">
                {{ $shippingOrders }}
            </p>
        </div>

        <div class="p-4 bg-green-100 rounded text-center">
            <p class="text-gray-600">Hoàn thành</p>
            <p class="text-2xl font-bold text-green-700">
                {{ $completedOrders }}
            </p>
        </div>

        <div class="p-4 bg-red-100 rounded text-center">
            <p class="text-gray-600">Đã hủy</p>
            <p class="text-2xl font-bold text-red-700">
                {{ $canceledOrders }}
            </p>
        </div>

    </div>
</div>

@endsection
