<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::create(['name' => 'Fruits']);
        Category::create(['name' => 'Vegetables']);
        Category::create(['name' => 'Dairy']);
        Category::create(['name' => 'Beverages']);
        Category::create(['name' => 'Snacks']);
        Category::create(['name' => 'Bakery']);
        Category::create(['name' => 'Frozen Foods']);
        Category::create(['name' => 'Meats']);
        Category::create(['name' => 'Cereals']);
        Category::create(['name' => 'Personal Care']);
        Category::create(['name' => 'Cleaning Supplies']);
        Category::create(['name' => 'Spices']);
        Category::create(['name' => 'Grains & Legumes']);
        Category::create(['name' => 'Pet Food']);
    }

}
