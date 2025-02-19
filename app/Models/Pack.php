<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model {
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'pack_product');
    }
}
