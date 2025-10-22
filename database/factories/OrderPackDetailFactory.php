<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Pack;

class OrderPackDetailFactory extends Factory
{
    protected $model = \App\Models\OrderPackDetail::class;

    public function definition()
    {
        $pack = Pack::inRandomOrder()->first() ?? Pack::factory()->create();
        $quantity = $this->faker->numberBetween(1, 5);
        $subtotal = $pack->price * $quantity;

        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? Order::factory(),
            'pack_id' => $pack->id,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
