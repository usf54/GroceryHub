<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class PackFactory extends Factory
{
    protected $model = \App\Models\Pack::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'img' => $this->faker->imageUrl(640, 480, 'food', true),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
