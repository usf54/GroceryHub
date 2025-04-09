<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    // Add product to cart (Session-based)
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

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('cart', compact('cart', 'total'));
    }

    public function remove($id)
    {
        // Check if the cart exists in the session
        if (session()->has('cart')) {
            $cart = session('cart');
            
            // Remove the product from the cart using its ID
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart); // Update the session with the modified cart
                return redirect()->back()->with('success', 'Product removed from cart.');
            }
        }
    
        return redirect()->back()->with('error', 'Product not found in the cart.');
    }
    
    // Show Checkout Form
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        // Loyalty Discount: 5% if user has 3+ completed orders
        $user = Auth::user();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->count();
        $discount = $completedOrders >= 5 ? round($total * 0.10, 2) : 0;

        // Free Shipping Logic
        $shipping = ($total >= 100) ? 0 : 10;

        $finalTotal = $total - $discount + $shipping;

        return view('checkout', compact('cart', 'total', 'discount', 'shipping', 'finalTotal'));
    }

    // Process Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $subtotal = array_sum(array_column($cart, 'subtotal'));

        // Loyalty Discount: 5% if user has 3+ completed orders
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->count();
        $discount = $completedOrders >= 5 ? round($subtotal * 0.10, 2) : 0;

        // Free Shipping Logic
        $shipping = ($subtotal >= 100) ? 0 : 10;

        $finalTotal = $subtotal - $discount + $shipping;

        $order = Order::create([
            'user_id'    => $user->id,
            'status'     => 'pending',
            'order_date' => now(),
            'address'    => $request->address,
            'city'       => $request->city,
            'phone'      => $request->phone,
            'total'      => $subtotal,
            'discount'   => $discount,
            'shipping'   => $shipping,
            'final_total'=> $finalTotal,
        ]);

        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'subtotal'   => $item['subtotal'],
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('products.list')
            ->with('success', 'Order placed successfully! You saved $' . number_format($discount, 2) . '. Order ID: #' . $order->id);
    }
    // Admin order management methods...
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }

}
