<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Pack;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPackDetail;
use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedUser;
use App\Mail\OrderPlacedAdmin;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class OrderController extends Controller
{
    // Add item (product or pack) to cart
    public function addToCart(Request $request, $type, $id)
    {
        $cart = session()->get('cart', []);

        if ($type === 'product') {
            $item = Product::findOrFail($id);
        } elseif ($type === 'pack') {
            $item = Pack::findOrFail($id);
        } else {
            return redirect()->back()->with('error', 'Invalid item type.');
        }

        $key = $type . '_' . $id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->input('quantity', 1);
            $cart[$key]['subtotal'] = $cart[$key]['quantity'] * $cart[$key]['price'];
        } else {
            $cart[$key] = [
                'id'       => $id,
                'name'     => $item->name,
                'price'    => $item->price,
                'quantity' => $request->input('quantity', 1),
                'subtotal' => $item->price * $request->input('quantity', 1),
                'type'     => $type,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', ucfirst($type) . ' added to cart successfully!');
    }

    // View cart
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('cart', compact('cart', 'total'));
    }

    // Remove item from cart
    public function remove($key)
    {
        if (session()->has('cart')) {
            $cart = session('cart');
            if (isset($cart[$key])) {
                unset($cart[$key]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Item removed from cart.');
            }
        }

        return redirect()->back()->with('error', 'Item not found in the cart.');
    }

    // Show checkout page
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        $total = array_sum(array_column($cart, 'subtotal'));
        $user = Auth::user();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'shipped')->count();
        $discount = $completedOrders >= 5 ? round($total * 0.10, 2) : 0;
        $shipping = ($total >= 100) ? 0 : 10;
        $finalTotal = $total - $discount + $shipping;

        return view('checkout', compact('cart', 'total', 'discount', 'shipping', 'finalTotal'));
    }

    // Process checkout and create order
    public function createPayment(Request $request)
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

        // Store checkout info in session
        session()->put('checkout', [
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mad', // or 'usd'
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => intval($item['price'] * 100), // convert to cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $subtotal = array_sum(array_column($cart, 'subtotal'));
        $completedOrders = Order::where('user_id', Auth::id())->where('status', 'shipped')->count();
        $discount = $completedOrders >= 5 ? round($subtotal * 0.10, 2) : 0;
        $shipping = ($subtotal >= 100) ? 0 : 10;
        $finalTotal = $subtotal - $discount + $shipping;

        // Add shipping line
        if ($shipping > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => ['name' => 'Shipping'],
                    'unit_amount' => intval($shipping * 100),
                ],
                'quantity' => 1,
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'user_id' => Auth::id(),
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
            ],
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.list')->with('error', 'No cart found.');
        }

        // Create the order (same logic as your checkout)
        $user = Auth::user();
        $subtotal = array_sum(array_column($cart, 'subtotal'));
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'shipped')->count();
        $discount = $completedOrders >= 5 ? round($subtotal * 0.10, 2) : 0;
        $shipping = ($subtotal >= 100) ? 0 : 10;
        $finalTotal = $subtotal - $discount + $shipping;

        $order = Order::create([
            'user_id'     => $user->id,
            'status'      => 'pending',
            'order_date'  => now(),
            'address'     => session('checkout.address'),
            'city'        => session('checkout.city'),
            'phone'       => session('checkout.phone'),
            'total'       => $subtotal,
            'discount'    => $discount,
            'shipping'    => $shipping,
            'final_total' => $finalTotal,
        ]);

        foreach ($cart as $item) {
            if ($item['type'] === 'product') {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'quantity'   => $item['quantity'],
                    'subtotal'   => $item['subtotal'],
                ]);
                Product::find($item['id'])?->decrement('stock', $item['quantity']);
            } elseif ($item['type'] === 'pack') {
                OrderPackDetail::create([
                    'order_id' => $order->id,
                    'pack_id'  => $item['id'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
                Pack::find($item['id'])?->decrement('stock', $item['quantity']);
            }
        }

        $order = Order::with(['orderDetails.product', 'orderPackDetails.pack', 'user'])->find($order->id);

        // Send queued emails
        Mail::to($order->user->email)->send(new OrderPlacedUser($order));
        Mail::to('hostigo05@gmail.com')->queue(new OrderPlacedAdmin($order));

        session()->forget('cart');
        session()->forget('checkout');

        return redirect()->route('products.list')->with('success', 'Payment successful! Order placed.');
    }

    public function paymentCancel()
    {
    return redirect()->route('checkout.form')->with('error', 'Payment was cancelled.');
    }

    // Admin: View all orders
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Admin: Edit order
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Admin: Update order status
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,shipped'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully!');
    }

    // Admin: Delete order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
