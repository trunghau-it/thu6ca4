<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Query gốc
        $query = Product::where('status', 'active');

        // Tìm kiếm theo tên
        if ($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // Lọc theo danh mục
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc sản phẩm giảm giá
        if ($request->sale == '1') {
            $query->whereNotNull('sale_price');
        }

        // Sắp xếp theo giá
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        // Phân trang
        $products = $query->paginate(8)->withQueryString();

        // Danh mục
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }
    public function show($slug)
{
    $product = Product::where('slug', $slug)
        ->with('images', 'category')
        ->firstOrFail();

    return view('products.show', compact('product'));
}
}
