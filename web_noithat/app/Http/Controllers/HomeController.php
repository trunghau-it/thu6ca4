<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Danh mục nội thất
        $categories = Category::all();

        // Sản phẩm nổi bật (có giá khuyến mãi)
        $featuredProducts = Product::whereNotNull('sale_price')
            ->where('status', 'active')
            ->limit(8)
            ->get();

        // Sản phẩm mới nhất
        $latestProducts = Product::where('status', 'active')
            ->latest()
            ->limit(8)
            ->get();

        return view('home.index', compact(
            'categories',
            'featuredProducts',
            'latestProducts'
        ));
    }
}
