@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📊 Thống kê & Báo cáo</h1>

<!-- FILTER -->
<form class="flex gap-4 mb-6">
    <input type="date" name="from" value="{{ request('from') }}"
           class="border rounded px-3 py-2">

    <input type="date" name="to" value="{{ request('to') }}"
           class="border rounded px-3 py-2">

    <button class="bg-indigo-600 text-white px-4 rounded">
        Lọc
    </button>

    <a href="{{ route('admin.reports.pdf', request()->all()) }}"
       class="ml-auto bg-red-600 text-white px-4 py-2 rounded">
        Xuất PDF
    </a>
</form>
{{--
<!-- PHẦN 1 -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Tổng doanh thu</p>
        <p class="text-2xl font-bold text-green-600">
            {{ number_format($totalRevenue) }}đ
        </p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Số đơn</p>
        <p class="text-2xl font-bold">{{ $orderCount }}</p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Trung bình / đơn</p>
        <p class="text-2xl font-bold">
            {{ number_format($averageOrder) }}đ
        </p>
    </div>
</div> --}}

{{-- <!-- PHẦN 2 -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-5 rounded-xl shadow">
        <h2 class="font-semibold mb-3">🔥 Sản phẩm bán chạy</h2>
        <ul>
            @foreach($bestProducts as $p)
                <li class="flex justify-between border-b py-2">
                    <span>{{ $p->product_name }}</span>
                    <b>{{ $p->total_qty }}</b>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <h2 class="font-semibold mb-3">🐢 Sản phẩm bán chậm</h2>
        <ul>
            @foreach($slowProducts as $p)
                <li class="flex justify-between border-b py-2">
                    <span>{{ $p->product_name }}</span>
                    <b>{{ $p->total_qty }}</b>
                </li>
            @endforeach
        </ul>
    </div>
</div> --}}

{{-- <!-- PHẦN 3 -->
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="font-semibold mb-4">📅 Đơn hàng theo ngày</h2>

    @foreach($ordersByDay as $date => $list)
        <h3 class="font-semibold mt-4">{{ $date }}</h3>
        <table class="w-full text-sm mt-2">
            @foreach($list as $o)
            <tr class="border-b">
                <td>#{{ $o->id }}</td>
                <td>{{ $o->name }}</td>
                <td>{{ number_format($o->total) }}đ</td>
                <td>{{ $o->status_text }}</td>
            </tr>
            @endforeach
        </table>
    @endforeach
</div> --}}
@endsection
