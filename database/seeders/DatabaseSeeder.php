<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Demo\UserSeeder;
use Database\Seeders\Demo\CategorySeeder;
use Database\Seeders\Demo\ProductSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call([
        //     UserSeeder::class,
        //     CategorySeeder::class,
        //     ProductSeeder::class,
        //     PackSeeder::class,
        //     PackProductSeeder::class,
        //     OrderSeeder::class,
        //     OrderDetailSeeder::class,
        //     OrderPackDetailSeeder::class,
        // ]);

        // Demo 
        $this->call([
        
            AdminSeeder::class,
        
            UserSeeder::class,
        
            CategorySeeder::class,
        
            ProductSeeder::class,
        
        ]);
    }

}