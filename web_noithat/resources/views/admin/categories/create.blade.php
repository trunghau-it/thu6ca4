@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">➕ Thêm danh mục</h1>

<form method="POST" action="{{ route('admin.categories.store') }}"
      class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block font-medium mb-1">Tên danh mục</label>
        <input type="text" name="name"
               class="w-full border rounded p-2"
               required>
            @error('name')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
@enderror

    </div>

    <div class="mb-4">
        <label class="block font-medium mb-1">Danh mục cha</label>
        <select name="parent_id" class="w-full border rounded p-2">
            <option value="">— Không có —</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}">
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
        Lưu
    </button>
</form>
@endsection
