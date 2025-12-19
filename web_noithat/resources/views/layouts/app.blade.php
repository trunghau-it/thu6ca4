<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nội Thất Của Hoài</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- NAVBAR -->
<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- LOGO -->
<a href="/" class="flex items-center gap-3">
    <img
        src="{{ asset('images/logo2.png') }}"
        alt="Nội Thất Của Hoài"
        class="h-10 w-10 object-contain"
    >
    <span class="text-2xl font-bold text-indigo-600">
        NỘI THẤT CỦA HOÀI
    </span>
</a>



            <!-- MENU DESKTOP -->
            <div class="hidden md:flex items-center gap-8 font-medium">
                <a href="/" class="hover:text-indigo-600">Trang chủ</a>
                <a href="/products" class="hover:text-indigo-600">Sản phẩm</a>
                <a href="#footer" class="hover:text-indigo-600">Liên hệ</a>
                @auth
                    <a href="/orders" class="hover:text-indigo-600">
                        Đơn hàng
                    </a>
                @endauth
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                        class="hover:text-indigo-600 font-semibold">
                            Dashboard
                        </a>
                    @endif
                @endauth

            </div>


            <!-- SEARCH + CART + AUTH -->
            <div class="hidden md:flex items-center gap-5">

                <!-- SEARCH -->
                <form action="/products" method="GET" class="relative">
                    <input type="text" name="keyword"
                        placeholder="Tìm nội thất..."
                        class="border rounded-full pl-4 pr-10 py-1 focus:ring-2 focus:ring-indigo-400">
                    <button class="absolute right-2 top-1.5">🔍</button>
                </form>

                <!-- CART ICON -->
                @php
                    $cart = session('cart', []);
                    $cartCount = collect($cart)->sum('quantity');
                @endphp

                <a href="/cart" class="relative text-2xl">
                    🛒
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs
                                   w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- AUTH -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <!-- Nút bấm -->
                        <button
                            @click="open = !open"
                            class="font-medium flex items-center gap-1"
                        >
                            {{ auth()->user()->name }}
                        </button>

                        <!-- Dropdown -->
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-40 bg-white border rounded shadow z-50"
                        >
                            {{-- <a href="/orders" class="block px-4 py-2 hover:bg-gray-100">
                                Đơn hàng
                            </a> --}}

                            <form method="POST" action="/logout">
                                @csrf
                                <button
                                    class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="/login" class="hover:text-indigo-600">Đăng nhập</a>
                    <a href="/register"
                    class="bg-indigo-600 text-white px-4 py-1.5 rounded-full">
                        Đăng ký
                    </a>
                    @endauth

            </div>

            <!-- MOBILE BUTTON -->
            <button id="menuBtn" class="md:hidden text-2xl">☰</button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
    <div class="px-4 py-3 space-y-3">
        <a href="/" class="block">Trang chủ</a>
        <a href="/products" class="block">Sản phẩm</a>

        @auth
            <a href="/orders" class="block">Đơn hàng</a>
        @endauth

        <a href="#footer" class="block">Liên hệ</a>

        <a href="/cart" class="block">
            🛒 Giỏ hàng
        </a>

        @auth
            <form method="POST" action="/logout">
                @csrf
                <button class="text-red-500">Đăng xuất</button>
            </form>
        @else
            <a href="/login" class="block">Đăng nhập</a>
            <a href="/register" class="block">Đăng ký</a>
        @endauth
    </div>
</div>

</nav>

<script>
    document.getElementById('menuBtn').onclick = function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
</script>

@if(session('success'))
<div id="toast-success"
     class="fixed top-16 right-0 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg
            flex items-center gap-3 z-50 transition-all">

    <!-- ICON -->
    <span class="text-2xl">✔</span>

    <!-- MESSAGE -->
    <span>{{ session('success') }}</span>
</div>

<script>
    setTimeout(() => {
        const toast = document.getElementById('toast-success');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-20px)';
            setTimeout(() => toast.remove(), 500);
        }
    }, 2500);
</script>
@endif


<!-- CONTENT -->
<main class="flex-grow">
    <div class="max-w-7xl mx-auto p-6">
        @yield('content')
    </div>
</main>
<footer id="footer" class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        <div>
    <div class="flex items-center gap-3 mb-3">
        <img src="{{ asset('images/logo2.png') }}" alt="Nội Thất Của Hoài" class="h-20 w-20 object-contain">
        <h3 class="text-xl font-bold text-indigo-600">
            NỘI THẤT CỦA HOÀI
        </h3>
    </div>

    <p class="text-gray-600">
        Chuyên cung cấp nội thất hiện đại, chất lượng cao.
    </p>
</div>


        <div>
            <h4 class="font-semibold mb-3">Liên hệ</h4>
            <p>📍 TP. Hồ Chí Minh</p>
            <p>📞 0909 999 999</p>
            <p>✉️ noithathoai@gmail.com</p>
        </div>

        <div>
            <h4 class="font-semibold mb-3">Hỗ trợ</h4>
            <p>Chính sách bảo hành</p>
            <p>Hướng dẫn mua hàng</p>
        </div>

    </div>

    <div class="text-center py-4 bg-gray-800 text-sm">
        © {{ date('Y') }} Bản quyền thuộc về Nguyễn Trung Hậu
    </div>
</footer>

<!-- DELETE CONFIRM MODAL -->
<div id="deleteModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg animate-fade-in">

        <h3 class="text-xl font-bold mb-4 text-gray-800">
            Xác nhận xóa sản phẩm
        </h3>

        <p class="text-gray-600 mb-6">
            Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?
        </p>

        <div class="flex justify-end gap-4">
            <button onclick="closeDeleteModal()"
                    class="px-4 py-2 border rounded hover:bg-gray-100">
                Hủy
            </button>

            <form method="POST" action="{{ route('cart.remove') }}">
                @csrf
                <input type="hidden" name="product_id" id="deleteProductId">
                <button
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Xóa
                </button>
            </form>
        </div>

    </div>
</div>


<!-- JS MOBILE MENU -->
<script>
    document.getElementById('menuBtn').onclick = function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
    html {
        scroll-behavior: smooth;
    }
</script>
{{-- JS DELETE MODAL --}}
<script>
    function openDeleteModal(productId) {
        document.getElementById('deleteProductId').value = productId;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
{{-- // JS mượt màng --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fade-in {
    animation: fadeIn 0.2s ease-out;
}
</style>


</body>
</html>
