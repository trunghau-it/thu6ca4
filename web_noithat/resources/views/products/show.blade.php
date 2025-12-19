@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-10">

    <!-- GALLERY ẢNH -->
    <div>
        <!-- ẢNH CHÍNH -->
        <img id="mainImage"
             src="{{ $product->thumbnail }}"
             class="w-full h-96 object-cover rounded-lg shadow mb-4">

        <!-- ẢNH PHỤ -->
        <div class="flex gap-3">
            <img src="{{ $product->thumbnail }}"
                 onclick="changeImage(this.src)"
                 class="w-20 h-20 object-cover rounded cursor-pointer border">

            @foreach($product->images as $img)
                <img src="{{ $img->image }}"
                     onclick="changeImage(this.src)"
                     class="w-20 h-20 object-cover rounded cursor-pointer border">
            @endforeach
        </div>
    </div>

    <!-- THÔNG TIN -->
    <div>
        <p class="text-gray-500 mb-1">
            Danh mục: {{ $product->category->name }}
        </p>

        <h1 class="text-3xl font-bold mb-4">
            {{ $product->name }}
        </h1>

        <!-- GIÁ -->
        @if($product->sale_price)
            <div class="mb-4">
                <span class="text-3xl text-red-600 font-bold">
                    {{ number_format($product->sale_price) }}đ
                </span>
                <span class="line-through text-gray-500 ml-3">
                    {{ number_format($product->price) }}đ
                </span>
            </div>
        @else
            <div class="text-3xl font-bold text-indigo-600 mb-4">
                {{ number_format($product->price) }}đ
            </div>
        @endif

        <!-- MÔ TẢ -->
        <div class="text-gray-700 mb-6">
            {!! nl2br(e($product->description)) !!}
        </div>

        <!-- FORM THÊM GIỎ -->
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <button
                class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-indigo-700">
                🛒 Thêm vào giỏ hàng
            </button>
        </form>
    </div>

</div>

<!-- JS ĐỔI ẢNH -->
<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>

@endsection
