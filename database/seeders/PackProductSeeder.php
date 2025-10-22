<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pack;
use App\Models\Product;

class PackProductSeeder extends Seeder
{
    public function run()
    {
        Pack::all()->each(function ($pack) {
            $products = Product::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $pack->products()->sync($products); // attach random products
        });
    }
}
