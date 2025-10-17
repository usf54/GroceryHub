<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'name', 
        'description',
        'img', 
        'price', 
        'stock', 
        'category_id'
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function packs() 
    {
        return $this->belongsToMany(Pack::class, 'pack_product');
    }
}

