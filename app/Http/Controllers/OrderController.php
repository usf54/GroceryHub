<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    

    // 🔹 Add product to cart (Session-based)
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->input('quantity', 1);
            $cart[$product->id]['subtotal'] = $cart[$product->id]['quantity'] * $product->price;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
                'subtotal' => $product->price * $request->input('quantity', 1),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // 🔹 View Cart (Returns all items in session cart)
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // 🔹 Checkout (Create Order & OrderDetails, then clear session cart)
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'order_date' => now(),
            'total' => array_sum(array_column($cart, 'subtotal')),
        ]);

        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        session()->forget('cart'); // Clear cart after checkout

        return redirect()->back()->with('success', 'Order placed successfully!');
    }

     // Display all orders
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);; 
        return view('admin.orders.index', compact('orders'));
    }

    // Show form to edit an existing order
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Update an existing order
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,completed'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }
}

