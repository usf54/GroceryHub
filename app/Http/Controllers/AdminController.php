<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Pack;
use App\Models\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        
        $userRegistrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $productStocks = Product::select('name', 'stock')->orderBy('stock', 'desc')->get();

        $productsCount = Product::count();
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $packsCount = Pack::count();
        $ordersCount = Order::count();
        // Recent data
        $recentUsers = User::latest()->take(5)->get(); 
        $recentProducts = Product::latest()->take(5)->get(); 
        $recentOrders = Order::latest()->take(10)->get();
        $userRegistrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $productStocks = Product::select('name', 'stock')->orderBy('stock', 'desc')->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'productsCount',
            'categoriesCount',
            'packsCount',
            'ordersCount',
            'recentUsers',
            'recentProducts',
            'recentOrders',
            'userRegistrations',
            'productStocks'
        ));
        
    }

    // Manage Products
    public function manageProducts()
    {
        $products = Product::all();
        
        return view('admin.products.index', compact('products'));
    }

    // Manage Users
    public function manageUsers()
    {
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }
}
