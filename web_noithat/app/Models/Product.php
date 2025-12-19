<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'thumbnail',
        'description',
        'status'
    ];

    /**
     * Quan hệ: Sản phẩm thuộc về 1 danh mục
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Quan hệ: Sản phẩm có nhiều hình ảnh
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Lấy giá hiển thị (nếu có khuyến mãi thì lấy sale_price)
     */
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
}
