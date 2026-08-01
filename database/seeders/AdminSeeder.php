<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@grocery.com',            
            'email_verified_at'=>now(),
            'password' => Hash::make('password'),
            'address' => 'Grocery Store HQ',
            'phone' => '0600000000',
            'role' => 'admin'
        ]);
    }
}