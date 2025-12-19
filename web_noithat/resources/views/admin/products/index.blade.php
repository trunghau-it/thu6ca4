

@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        🪑 Quản lý sản phẩm
    </h1>

    <form class="flex gap-3 mb-4">
    <input name="keyword" placeholder="Tìm sản phẩm"
           class="border px-3 py-2 rounded">

    <select name="category_id" class="border px-3 py-2 rounded">
        <option value="">-- Danh mục --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <button class="bg-indigo-600 text-white px-4 rounded">Lọc</button>

    <a href="{{ route('admin.products.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700">
        + Thêm sản phẩm
    </a>
</form>

</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="p-4 text-left">Ảnh</th>
                <th class="text-left">Tên</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th class="text-right p-4">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-4">
                    @if($p->thumbnail)
                        <img src="{{ asset('storage/'.$p->thumbnail) }}"
                             class="w-14 h-14 rounded-lg object-cover">
                    @else
                        <div class="w-14 h-14 bg-gray-200 rounded-lg"></div>
                    @endif
                </td>

                <td class="font-medium text-gray-800">
                    {{ $p->name }}
                </td>

                <td class="text-gray-700">
                    {{ number_format($p->price) }}đ
                </td>

                <td>
                    @if($p->status)
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Hiển thị
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-600">
                            Ẩn
                        </span>
                    @endif
                </td>

                <td class="p-4 text-right space-x-2">
                    <a href="{{ route('admin.products.edit', $p) }}"
                       class="text-blue-600 hover:underline">
                        ✏️ Sửa
                    </a>

                    <form method="POST"
                          action="{{ route('admin.products.toggle', $p) }}"
                          class="inline">
                        @csrf @method('PATCH')
                        <button class="text-orange-600 hover:underline">
                            {{ $p->status ? 'Ẩn' : 'Hiện' }}
                        </button>
                    </form>

                    {{-- <form method="POST"
                          action="{{ route('admin.products.destroy', $p) }}"
                          class="inline"
                          onsubmit="return confirm('Xóa sản phẩm?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">
                            🗑️
                        </button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

