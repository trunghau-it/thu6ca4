@extends('layouts.app')

@section('content')

<!-- BANNER -->
<div class="mb-10">
    <div class="bg-indigo-400 text-white rounded-lg p-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-3">
                Nội thất hiện đại cho mọi không gian
            </h1>
            <p class="mb-5">
                Khám phá các sản phẩm nội thất chất lượng – giá tốt
            </p>
            <a href="/products"
               class="bg-white text-indigo-600 px-6 py-2 rounded font-semibold">
                Xem sản phẩm
            </a>
        </div>
        <img src="https://www.lanha.vn/wp-content/uploads/2024/06/thiet-ke-noi-that-nha-pho-117.jpg.webp"
             class="w-40 hidden md:block">
    </div>
</div>

<!-- DANH MỤC -->
<h2 class="text-2xl font-bold mb-6">Danh mục nội thất</h2>
<div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-12">
    @foreach($categories as $category)
        <a href="/products?category={{ $category->id }}"
           class="bg-white p-6 rounded-lg shadow text-center hover:shadow-lg transition">
            <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
        </a>
    @endforeach
</div>

<!-- SẢN PHẨM NỔI BẬT -->
<h2 class="text-2xl font-bold mb-6">Sản phẩm nổi bật</h2>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    @foreach($featuredProducts as $product)
        <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ $product->thumbnail }}"
                 class="w-full h-40 object-cover rounded mb-3">

            <h3 class="font-semibold">{{ $product->name }}</h3>

            <div class="mt-2">
                <span class="text-red-600 font-bold">
                    {{ number_format($product->sale_price) }}đ
                </span>
                <span class="line-through text-gray-500 ml-2">
                    {{ number_format($product->price) }}đ
                </span>
            </div>

            <a href="/products/{{ $product->slug }}"
               class="block mt-3 text-center bg-indigo-600 text-white py-2 rounded">
                Xem chi tiết
            </a>
        </div>
    @endforeach
</div>

<!-- SẢN PHẨM MỚI -->
<h2 class="text-2xl font-bold mb-6">Sản phẩm mới nhất</h2>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach($latestProducts as $product)
        <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ $product->thumbnail }}"
                 class="w-full h-40 object-cover rounded mb-3">

            <h3 class="font-semibold">{{ $product->name }}</h3>

            <div class="mt-2 font-bold text-indigo-600">
                {{ number_format($product->price) }}đ
            </div>

            <a href="/products/{{ $product->slug }}"
               class="block mt-3 text-center bg-gray-800 text-white py-2 rounded">
                Xem chi tiết
            </a>
        </div>
    @endforeach
</div>

@endsection
