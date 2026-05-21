<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverOrderController extends Controller
{
    // LIST ORDERS
    public function index()
    {
        return view('driver.orders');
    }

    // ORDER DETAILS
    public function show()
    {

        return view('driver.order-details');
    }
}