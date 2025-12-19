<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-gray-900 text-white min-h-screen">
    <div class="p-4 text-xl font-bold border-b border-gray-700">
        ADMIN PANEL
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            📊 Dashboard
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            📁 Quản lý danh mục
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            🛋️ Quản lý sản phẩm
        </a>


         <a href="{{ route('admin.orders.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            📦 Quản lý đơn hàng
        </a>
{{--
        <a href="{{ route('admin.users.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            👤 Quản lý người dùng
        </a>
--}}
        <a href="{{ route('admin.reports.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            📈 Thống kê & Báo cáo
        </a>
         <a href="{{ route('home') }}"
       class="flex items-center gap-2 bg-white text-indigo-600 px-4 py-2 rounded-lg shadow hover:bg-indigo-50">
        ← Quay lại web
    </a>
    </nav>
</aside>

<!-- CONTENT -->
<div class="flex-1 flex flex-col">

    <!-- TOP BAR -->
    <header class="bg-white shadow p-4 flex justify-between">
        <span>Xin chào, <strong>{{ auth()->user()->name }}</strong></span>

        <form method="POST" action="/logout">
            @csrf
            <button class="text-red-500">Đăng xuất</button>
        </form>
    </header>

    <!-- PAGE CONTENT -->
    <main class="p-6 flex-grow">
        @yield('content')
    </main>

</div>

</body>
</html>
