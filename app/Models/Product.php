<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'gallery_image',
        'manufacturer_name',
        'manufacturer_brand',
        'stock',
        'price',
        'discount',
        'orders',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'visibility',
        'published_date',
        'category_id',
        'tags',
        'product_short_description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

