@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📄 Chi tiết đơn hàng #{{ $order->id }}</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- THÔNG TIN KHÁCH -->
    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-semibold mb-3">Thông tin khách hàng</h2>
        <p><b>Tên:</b> {{ $order->customer_name }}</p>
        <p><b>SĐT:</b> {{ $order->customer_phone }}</p>
        <p><b>Địa chỉ:</b> {{ $order->customer_address }}</p>
        <p><b>Ngày đặt:</b> {{ $order->created_at }}</p>
        <p><b>Ngày cập nhật:</b> {{ $order->updated_at }}</p><hr>
        <p class="mt-2"><b>Tổng:</b> {{ number_format($order->total_price) }}đ</p>
    </div>

    <!-- DANH SÁCH SẢN PHẨM -->
    <div class="bg-white rounded-xl shadow p-5 md:col-span-2">
        <h2 class="font-semibold mb-3">Sản phẩm</h2>

        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-2 text-left">Tên</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->Product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- CẬP NHẬT TRẠNG THÁI -->
        <form method="POST"
              action="{{ route('admin.orders.update', $order) }}"
              class="mt-4 flex items-center gap-3">
            @csrf
            @method('PUT')

            <select name="status"
                    class="border rounded px-3 py-2">
                <option value="pending">Chờ xác nhận</option>
                <option value="confirmed">Đã xác nhận</option>
                <option value="shipping">Đang giao</option>
                <option value="completed">Hoàn thành</option>
                <option value="cancelled">Hủy</option>
            </select>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Cập nhật
            </button>
        </form>

        <!-- HỦY ĐƠN -->
        @if($order->status !== 'cancelled')
        <form method="POST"
              action="{{ route('admin.orders.destroy', $order) }}"
              class="mt-3"
              onsubmit="return confirm('Hủy đơn hàng này?')">
            @csrf
            @method('DELETE')
            <button class="text-red-600 underline">
                Hủy đơn hàng
            </button>
        </form>
        @endif
    </div>

</div>
@endsection
