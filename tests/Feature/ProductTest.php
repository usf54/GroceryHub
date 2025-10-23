<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_home_page_with_products()
    {
        Category::factory()->count(3)->create();
        Product::factory()->count(15)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas(['products', 'randomProducts', 'latestProducts']);
    }

    #[Test]
    public function it_searches_products()
    {
        $product = Product::factory()->create(['name' => 'Test Product']);
        
        $response = $this->get('/live-search?query=Test');
        
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Test Product']);
    }

    #[Test]
    public function it_lists_products_with_filters()
    {
        Category::factory()->create();
        Product::factory()->count(15)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    #[Test]
    public function it_shows_product_details()
    {
        $product = Product::factory()->create();

        $response = $this->get('/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertViewHas('product');
    }

    #[Test]
    public function admin_can_create_product()
    {
        Storage::fake('public');
        $user = \App\Models\User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        
        $category = Category::factory()->create();

        $response = $this->post('/admin/products', [
            'name' => 'New Product',
            'description' => 'Product description',
            'price' => 99.99,
            'stock' => 10,
            'category_id' => $category->id,
            'img' => UploadedFile::fake()->image('product.jpg')
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    #[Test]
    public function admin_can_update_product()
    {
        $user = \App\Models\User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        
        $product = Product::factory()->create();

        $response = $this->put('/admin/products/' . $product->id, [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 149.99,
            'stock' => 20,
            'category_id' => $product->category_id,
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);
    }

    #[Test]
    public function admin_can_delete_product()
    {
        $user = \App\Models\User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        
        $product = Product::factory()->create();

        $response = $this->delete('/admin/products/' . $product->id);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    #[Test]
    public function it_validates_product_creation()
    {
        $user = \App\Models\User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $response = $this->post('/admin/products', []);

        $response->assertSessionHasErrors(['name', 'price', 'stock', 'category_id']);
    }
}