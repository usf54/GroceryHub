<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 100; $i++) { 
            Product::create([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 0.5, 50), 
                'stock' => $faker->numberBetween(10, 100),  
                'category_id' => $faker->numberBetween(1, 14),  
            ]);
        }
    }

}
