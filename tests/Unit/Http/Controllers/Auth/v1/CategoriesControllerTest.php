<?php

namespace Tests\Unit\Http\Controllers\Auth\v1;

use Tests\TestCase;
use App\Http\Controllers\v1\CategoriesController;
use App\Services\v1\CategoriesService;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the database before each test
        $this->seed();
    }

    public function testDestroyCategory()
    {
        // Get a category from the seeded data
        $category = Category::first();

        // Delete any quotes associated with this category
        $category->quotes()->delete();

        $controller = new CategoriesController($this->app->make(CategoriesService::class));
        $response = $controller->destroy($category->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
