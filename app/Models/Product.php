<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'price',
        'discount_price',
        'description',
        'image',
        'status',
        'product_category_id',
        'featured',
    ];
    public function product_categories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

}
