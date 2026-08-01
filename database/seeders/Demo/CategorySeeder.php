<?php

namespace Database\Seeders\Demo;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {

        Category::create([
            'name'=>'Fruits',
            'image'=>'demo-category-thumb-1.jpg'
        ]);


        Category::create([
            'name'=>'Vegetables',
            'image'=>'demo-category-thumb-2.jpg'
        ]);


        Category::create([
            'name'=>'Drinks',
            'image'=>'demo-category-thumb-3.jpg'
        ]);


        Category::create([
            'name'=>'Snacks',
            'image'=>'demo-category-thumb-4.jpg'
        ]);

    }
}