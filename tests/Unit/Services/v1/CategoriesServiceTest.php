<?php

namespace Tests\Unit\Services\v1;

use App\Services\v1\CategoriesService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoriesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testGetCategories()
    {
        // Mock DB facade
        $queryBuilder = $this->getMockBuilder('Illuminate\Database\Query\Builder')
            ->disableOriginalConstructor()
            ->getMock();

        $queryBuilder->expects($this->once())
            ->method('select')
            ->willReturnSelf();

        $queryBuilder->expects($this->once())
            ->method('join')
            ->willReturnSelf();

        $queryBuilder->expects($this->once())
            ->method('groupBy')
            ->willReturnSelf();

        $queryBuilder->expects($this->once())
            ->method('get')
            ->willReturn(collect([
                (object)['category_id' => 1, 'category_name' => 'Category 1', 'quote_count' => 5],
                (object)['category_id' => 2, 'category_name' => 'Category 2', 'quote_count' => 10],
            ]));

        $query = $this->getMockBuilder('Illuminate\Database\Query\Builder')
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->once())
            ->method('table')
            ->willReturn($queryBuilder);

        DB::shouldReceive('table')
            ->once()
            ->andReturn($query);

        // Create an instance of the service
        $categoriesService = new CategoriesService();

        // Call the method being tested
        $categories = $categoriesService->getCategories([]);

        // Assertions
        $this->assertCount(2, $categories);

        $this->assertEquals(1, $categories[0]['category_id']);
        $this->assertEquals('Category 1', $categories[0]['category_name']);
        $this->assertEquals(5, $categories[0]['quote_count']);

        $this->assertEquals(2, $categories[1]['category_id']);
        $this->assertEquals('Category 2', $categories[1]['category_name']);
        $this->assertEquals(10, $categories[1]['quote_count']);
    }
}
