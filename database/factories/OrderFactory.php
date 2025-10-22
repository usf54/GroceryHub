<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition()
    {
        $total = $this->faker->randomFloat(2, 20, 500);
        $discount = $this->faker->randomFloat(2, 0, 50);
        $shipping = $this->faker->randomFloat(2, 0, 20);
        $finalTotal = $total - $discount + $shipping;

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
            'order_date' => $this->faker->dateTimeThisYear(),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'total' => $total,
            'discount' => $discount,
            'shipping' => $shipping,
            'final_total' => $finalTotal,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
