<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPackDetail extends Model
{
    protected $fillable = [
        'order_id',
        'pack_id',
        'quantity',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}
