<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'img' => $this->faker->imageUrl(640, 480, 'technics', true),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 5, 500), // between 5 and 500
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
