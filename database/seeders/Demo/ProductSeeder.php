<?php

namespace Database\Seeders\Demo;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{

    public function run(): void
    {

        $fruits = Category::where('name','Fruits')->first();

        $drinks = Category::where('name','Drinks')->first();



        Product::create([
            'name'=>'Apple',
            'description'=>'Fresh red apples',
            'img'=>'demo-category-thumb-31.jpg',
            'price'=>2.50,
            'stock'=>100,
            'category_id'=>$fruits->id
        ]);


        Product::create([
            'name'=>'Banana',
            'description'=>'Organic bananas',
            'img'=>'demo-category-thumb-32.jpg',
            'price'=>1.50,
            'stock'=>80,
            'category_id'=>$fruits->id
        ]);


        Product::create([
            'name'=>'Orange Juice',
            'description'=>'Fresh orange juice',
            'img'=>'demo-category-thumb-33.jpg',
            'price'=>3.50,
            'stock'=>50,
            'category_id'=>$drinks->id
        ]);

    }
}