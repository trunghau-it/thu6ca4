<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class ProductController extends Controller
{
    // 🔹 Danh sách + tìm kiếm + lọc danh mục
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // 🔹 Form thêm
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // 🔹 Lưu mới
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'price' => 'required|numeric',
        'thumbnail' => 'nullable|image',
        'images.*' => 'nullable|image',
    ]);

    $data = $request->only([
        'name', 'category_id', 'price', 'sale_price'
    ]);

    $data['slug'] = Str::slug($request->name);
    $data['status'] = $request->has('status');

    // 🔹 Upload ảnh đại diện
    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] =
            $request->file('thumbnail')->store('products', 'public');
    }

    $product = Product::create($data);

    // 🔹 Upload nhiều ảnh chi tiết
    if ($request->hasFile('images')) {
        foreach ($request->images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $img->store('products/details', 'public'),
            ]);
        }
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Đã thêm sản phẩm');
}



    // 🔹 Form sửa
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 🔹 Cập nhật
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'thumbnail' => 'nullable|image',
        'images.*' => 'nullable|image',
    ]);

    $data = $request->only([
        'name', 'category_id', 'price', 'sale_price'
    ]);

    $data['slug'] = Str::slug($request->name);
    $data['status'] = $request->has('status');

    // 🔹 Upload ảnh đại diện mới
    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] =
            $request->file('thumbnail')->store('products', 'public');
    }

    $product->update($data);

    // 🔹 Thêm ảnh chi tiết mới (không xóa ảnh cũ)
    if ($request->hasFile('images')) {
        foreach ($request->images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $img->store('products/details', 'public'),
            ]);
        }
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Đã cập nhật sản phẩm');
}


    // 🔹 Ẩn / hiện
    public function toggle(Product $product)
    {
        $product->update([
            'status' => !$product->status
        ]);

        return back();
    }
}
