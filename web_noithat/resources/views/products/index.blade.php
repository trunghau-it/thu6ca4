@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Danh sách sản phẩm</h1>

<!-- FORM TÌM KIẾM & LỌC -->
<form method="GET" action="/products"
      class="bg-white p-4 rounded shadow mb-8 grid grid-cols-1 md:grid-cols-5 gap-4">

    <!-- Tìm kiếm -->
    <input type="text" name="keyword"
           value="{{ request('keyword') }}"
           placeholder="Tìm sản phẩm..."
           class="border p-2 rounded col-span-2">

    <!-- Danh mục -->
    <select name="category_id" class="border p-2 rounded">
        <option value="">-- Danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <!-- Sắp xếp -->
    <select name="sort" class="border p-2 rounded">
        <option value="">-- Sắp xếp --</option>
        <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>
            Giá tăng dần
        </option>
        <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>
            Giá giảm dần
        </option>
    </select>

    <!-- Giảm giá -->
    <label class="flex items-center gap-2">
        <input type="checkbox" name="sale" value="1"
            {{ request('sale') ? 'checked' : '' }}>
        Đang giảm giá
    </label>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
        Lọc
    </button>
</form>

<!-- DANH SÁCH SẢN PHẨM -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="bg-white rounded shadow p-4">
            <img src="{{ $product->thumbnail }}"
                 class="w-full h-40 object-cover rounded mb-3">

            <h3 class="font-semibold mb-2">
                {{ $product->name }}
            </h3>

            @if($product->sale_price)
                <div>
                    <span class="text-red-600 font-bold">
                        {{ number_format($product->sale_price) }}đ
                    </span>
                    <span class="line-through text-gray-500 ml-2">
                        {{ number_format($product->price) }}đ
                    </span>
                </div>
            @else
                <div class="font-bold text-indigo-600">
                    {{ number_format($product->price) }}đ
                </div>
            @endif

            <a href="/products/{{ $product->slug }}"
               class="block mt-4 bg-gray-800 text-white text-center py-2 rounded">
                Xem chi tiết
            </a>
        </div>
    @empty
        <p class="col-span-4 text-center text-gray-500">
            Không có sản phẩm phù hợp
        </p>
    @endforelse
</div>

<!-- PHÂN TRANG -->
<div class="mt-8">
    {{ $products->links() }}
</div>

@endsection
