<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // default password
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'role' => $this->faker->randomElement(['admin', 'client']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
