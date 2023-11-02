<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_categories';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'image'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public function getProductCountAttribute()
    {
        return $this->products()->count();
    }

}
