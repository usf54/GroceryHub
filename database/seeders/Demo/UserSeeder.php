<?php

namespace Database\Seeders\Demo;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name'=>'John Customer',
            'email'=>'john@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password'),
            'address'=>'Casablanca',
            'phone'=>'0611111111',
            'role'=>'client'
        ]);
        
        
        User::create([
            'name'=>'Delivery Driver',
            'email'=>'driver@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password'),
            'address'=>'Casablanca',
            'phone'=>'0622222222',
            'role'=>'driver'
        ]);

    }
}