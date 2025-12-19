@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white p-8 rounded-lg shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">
            Đăng ký tài khoản
        </h2>

        <form method="POST" action="/register">
            @csrf

            <input type="text" name="name"
                class="w-full border p-2 rounded mb-3"
                placeholder="Họ tên" required>

            <input type="email" name="email"
                class="w-full border p-2 rounded mb-3"
                placeholder="Email" required>

            <input type="password" name="password"
                class="w-full border p-2 rounded mb-3"
                placeholder="Mật khẩu" required>

            <input type="password" name="password_confirmation"
                class="w-full border p-2 rounded mb-4"
                placeholder="Nhập lại mật khẩu" required>

            <button class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">
                Đăng ký
            </button>
        </form>

        <p class="mt-4 text-center">
            Đã có tài khoản?
            <a href="/login" class="text-indigo-600">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
