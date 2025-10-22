<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pack;
use App\Models\Product;

class PackProductFactory extends Factory
{
    protected $model = \App\Models\PackProduct::class;

    public function definition()
    {
        $pack = Pack::inRandomOrder()->first() ?? Pack::factory()->create();
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        return [
            'pack_id' => $pack->id,
            'product_id' => $product->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
