<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Pack;

class OrderPackDetailSeeder extends Seeder
{
    public function run()
    {
        // Assign 1–3 packs for each order
        foreach (Order::all() as $order) {
            $packs = Pack::inRandomOrder()->take(rand(1, 3))->get();
            foreach ($packs as $pack) {
                $order->orderPackDetails()->create([
                    'pack_id' => $pack->id,
                    'quantity' => $qty = rand(1, 5),
                    'subtotal' => $pack->price * $qty,
                ]);
            }
        }
    }
}
