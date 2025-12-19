@extends('layouts.app')

@section('content')

<div class="bg-white p-10 rounded shadow text-center max-w-xl mx-auto">
    <div class="text-green-600 text-5xl mb-4">✔</div>

    <h2 class="text-2xl font-bold mb-3">
        Đặt hàng thành công!
    </h2>

    <p class="mb-6">
        Cảm ơn bạn đã mua sắm tại Nội Thất Hoài.
        Đơn hàng sẽ được xử lý sớm nhất.
    </p>

    <a href="/orders"
       class="bg-indigo-600 text-white px-6 py-2 rounded">
        Xem đơn hàng của tôi
    </a>
</div>

@endsection
