@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">📂 Quản lý danh mục</h1>
    <a href="{{ route('admin.categories.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Thêm danh mục
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Tên danh mục</th>
                <th class="p-3">Danh mục cha</th>
                <th class="p-3 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3 font-medium">{{ $cat->name }}</td>
                    <td class="p-3 text-gray-500">
                        {{ $cat->parent->name ?? '—' }}
                    </td>
                    <td class="p-3 text-center">
                        <a href="{{ route('admin.categories.edit', $cat) }}"
                           class="text-blue-600 hover:underline mr-3">
                            Sửa
                        </a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Xóa danh mục này?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
