<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = [
        'user_id', 
        'status', 
        'order_date', 
        'total',
        'discount',
        'shipping',
        'final_total', 
        'address',
        'city',
        'phone'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function orderDetails() 
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderPackDetails()
    {
        return $this->hasMany(OrderPackDetail::class);
    }
}
