<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Pack;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_adds_product_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]), [
            'quantity' => 2
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertNotEmpty(session('cart'));
    }

    public function test_it_adds_pack_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $pack = Pack::factory()->create();

        $response = $this->post(route('order.add', ['type' => 'pack', 'id' => $pack->id]));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertNotEmpty(session('cart'));
    }

    public function test_it_shows_cart_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        
        // Add to cart first
        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]));
        
        $response = $this->get(route('cart.view'));

        $response->assertStatus(200);
        $response->assertViewIs('cart');
    }

    public function test_it_removes_item_from_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        
        // Add to cart first
        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]));
        
        $cartKey = 'product_' . $product->id;
        $response = $this->delete(route('cart.remove', $cartKey));

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_it_shows_checkout_page_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        
        // Add to cart first
        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]));
        
        $response = $this->get(route('checkout.form'));

        $response->assertStatus(200);
        $response->assertViewIs('checkout');
    }

    public function test_it_redirects_from_checkout_when_cart_is_empty()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('checkout.form'));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_it_validates_checkout_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]));

        $response = $this->post(route('payment.create'), []); // This matches createPayment method

        $response->assertSessionHasErrors(['address', 'city', 'phone']);
    }

    public function test_admin_can_view_orders_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Order::factory()->count(5)->create();

        $this->actingAs($admin);
        $response = $this->get(route('admin.orders.index'));

        $response->assertStatus(200);
        $response->assertViewHas('orders');
    }

    public function test_admin_can_update_order_status()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = Order::factory()->create();

        $this->actingAs($admin);
        $response = $this->put(route('admin.orders.update', $order), [
            'status' => 'shipped'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertEquals('shipped', $order->fresh()->status);
    }

    public function test_admin_can_delete_order()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = Order::factory()->create();

        $this->actingAs($admin);
        $response = $this->delete(route('admin.orders.destroy', $order));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_it_applies_discount_for_loyal_customers()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        // Create 5 completed orders for this user
        Order::factory()->count(5)->create([
            'user_id' => $user->id,
            'status' => 'shipped'
        ]);
        
        $product = Product::factory()->create(['price' => 100]);

        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]), ['quantity' => 1]);
        
        $response = $this->get(route('checkout.form'));
        
        $response->assertStatus(200);
        $response->assertSee('10.00'); // Check if discount is displayed (10% of 100)
    }

    public function test_it_applies_free_shipping_for_high_value_orders()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create(['price' => 150]);

        $this->post(route('order.add', ['type' => 'product', 'id' => $product->id]), ['quantity' => 1]);
        
        $response = $this->get(route('checkout.form'));
        
        $response->assertStatus(200);
        $response->assertSee('0.00'); // Check if shipping is 0
    }
}