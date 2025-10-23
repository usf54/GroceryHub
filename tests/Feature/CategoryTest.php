<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $client;

    protected function setUp(): void
    {
        parent::setUp();

        // Admin and client users
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->client = User::factory()->create(['role' => 'client']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function all_categories_can_be_listed(): void
    {
        Category::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)
                         ->get('/admin/categories');

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_create_a_category(): void
    {
        $data = [
            'name' => 'New Category',
            'image' => UploadedFile::fake()->image('category.jpg'),
        ];

        $response = $this->actingAs($this->admin)
                         ->post('/admin/categories', $data);

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function cannot_create_category_without_name(): void
    {
        $data = [
            'name' => '',
            'image' => UploadedFile::fake()->image('category.jpg'),
        ];

        $response = $this->actingAs($this->admin)
                         ->post('/admin/categories', $data);

        $response->assertSessionHasErrors(['name']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_update_a_category(): void
    {
        $category = Category::factory()->create(['name' => 'Old Name']);

        $data = [
            'name' => 'Updated Name',
            'image' => UploadedFile::fake()->image('updated.jpg'),
        ];

        $response = $this->actingAs($this->admin)
                         ->put("/admin/categories/{$category->id}", $data);

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_delete_a_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)
                         ->delete("/admin/categories/{$category->id}");

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
