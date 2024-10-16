<?php

namespace App\Models\Frontend;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function brand(){
        return $this->belongsTo(Brand::class);
    }


    protected $fillable = [ 'price', 'quantity', 'img', 'title'];

}
