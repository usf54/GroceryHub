<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDetail;
use App\Models\Order;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        // Assign 1–5 products for each order
        foreach (Order::all() as $order) {
            $productsCount = rand(1, 5);
            OrderDetail::factory()->count($productsCount)->create([
                'order_id' => $order->id,
            ]);
        }
    }
}
