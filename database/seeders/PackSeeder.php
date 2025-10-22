<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pack;

class PackSeeder extends Seeder
{
    public function run()
    {
        // Create 15 random packs
        Pack::factory()->count(15)->create();
    }
}
