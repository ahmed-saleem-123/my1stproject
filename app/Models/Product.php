<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = ['title', 'price', 'brand_id', 'category_id', 'img']; // Add 'img' here


    public function brand() {
        return $this->belongsTo(brand::class, 'brand_id', 'id');
    }
    public function category() {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
}
