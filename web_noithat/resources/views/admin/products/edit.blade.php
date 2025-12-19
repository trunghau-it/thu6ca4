@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-6">
    {{ isset($product) ? '✏️ Sửa sản phẩm' : '➕ Thêm sản phẩm' }}
</h1>

<form method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-xl shadow max-w-2xl space-y-4"
      action="{{ isset($product)
          ? route('admin.products.update', $product)
          : route('admin.products.store') }}">

    @csrf
    @isset($product) @method('PUT') @endisset

    <div>
        <label class="block font-medium mb-1">Tên sản phẩm</label>
        <input name="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium mb-1">Giá</label>
            <input name="price"
                   value="{{ old('price', $product->price ?? '') }}"
                   class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Giá khuyến mãi</label>
            <input name="sale_price"
                   value="{{ old('sale_price', $product->sale_price ?? '') }}"
                   class="w-full border rounded-lg p-2">
        </div>
    </div>

    <div>
        <label class="block font-medium mb-1">Ảnh đại diện</label>
        <input type="file" name="thumbnail">
        @isset($product)
            @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}"
                     class="w-24 mt-2 rounded-lg">
            @endif
        @endisset
    </div>

    <div>
        <label class="block font-medium mb-1">Ảnh chi tiết</label>
        <input type="file" name="images[]" multiple>
        @isset($product)
            <div class="flex gap-2 mt-2 flex-wrap">
                @foreach($product->images as $img)
                    <img src="{{ asset('storage/'.$img->image) }}"
                         class="w-20 h-20 object-cover rounded-lg">
                @endforeach
            </div>
        @endisset
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" name="status"
               @checked(old('status', $product->status ?? true))>
        Hiển thị
    </label>

    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
        Lưu
    </button>
</form>
@endsection
