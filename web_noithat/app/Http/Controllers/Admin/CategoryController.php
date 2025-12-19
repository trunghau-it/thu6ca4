<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Danh sách
    public function index()
    {
        $categories = Category::with('parent')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Form thêm
    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parents'));
    }

    // Lưu mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->name);

        // Kiểm tra trùng slug
        if (Category::where('slug', $slug)->exists()) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'Danh mục đã tồn tại']);
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $request->filled('parent_id')
                ? $request->parent_id
                : null
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã thêm danh mục');
    }


    // Form sửa
    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    // Cập nhật
    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $slug = Str::slug($request->name);

    // Kiểm tra trùng slug (trừ chính nó)
    if (
        Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists()
    ) {
        return back()
            ->withInput()
            ->withErrors(['name' => 'Danh mục đã tồn tại']);
    }

    $category->update([
        'name' => $request->name,
        'slug' => $slug,
        'parent_id' => $request->filled('parent_id')
            ? $request->parent_id
            : null
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Đã cập nhật danh mục');
}



    // Xóa
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã xóa danh mục');
    }
}
