<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_category_can_be_created()
    {
        $this->withoutMiddleware();
        $data = [
            'name' => 'New Category'
        ];
        $response = $this->postJson('api/category/add', $data);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'The Category is added Successfully',
            ]);
        $this->assertDatabaseHas('categories', [
            'name' => 'New Category'
        ]);
    }


    public function testFetchAllCategories()
    {
        $this->withoutMiddleware();
        Category::factory()->count(50000)->create();

        $response = $this->getJson('api/category/all');
        $response->assertStatus(200);
        $response->assertJsonCount(50000, 'data');
    }


    public function testGetCategoryById()
    {
        $this->withoutMiddleware();
        $category = Category::factory()->create();

        $response = $this->getJson('api/category/get/' . $category->id);
        $response->assertStatus(200);
        $response->assertJson(['data' => ['id' => $category->id]]);
    }


    public function testDeleteCategory()
    {
        $this->withoutMiddleware();
        $category = Category::factory()->create();

        $response = $this->deleteJson('/api/category/delete/' . $category->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }


    public function testUpdateCategory()
    {
        $this->withoutMiddleware();
        $category = Category::factory()->create();
        $newData = ['name' => 'Updated Category Name'];

        $response = $this->postJson('api/category/update/' . $category->id, $newData);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'category updated successfully']);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Category Name']);
        $response = $this->postJson('api/category/update/999', ['name' => 'New Name']);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'not found']);
    }


    public function testSearchCategory()
    {
        $this->withoutMiddleware();
        $category = Category::factory()->create(['name' => 'Test Category']);

        $response = $this->getJson('api/category/search/Test');
        $response->assertStatus(200);
        $response->assertJson(['data' => [['id' => $category->id, 'name' => 'Test Category']]]);

        $response = $this->getJson('api/category/search/NonExistingCategory');
        $response->assertStatus(404);
        $response->assertJson(['message' => 'not found']);
    }
}
