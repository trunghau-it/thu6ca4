@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="bg-white p-8 rounded-lg shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">
            Đăng nhập tài khoản
        </h2>

        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email"
                class="w-full border p-2 rounded mb-3"
                placeholder="Email" required>

            <input type="password" name="password"
                class="w-full border p-2 rounded mb-3"
                placeholder="Mật khẩu" required>

            <label class="flex items-center mb-4">
                <input type="checkbox" name="remember" class="mr-2">
                Ghi nhớ đăng nhập
            </label>

            <button class="bg-indigo-600 text-white w-full py-2 rounded hover:bg-indigo-700">
                Đăng nhập
            </button>
        </form>

        <p class="mt-4 text-center">
            Chưa có tài khoản?
            <a href="/register" class="text-indigo-600">Đăng ký</a>
        </p>
    </div>
</div>
@endsection
