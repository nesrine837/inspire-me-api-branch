<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\v1\CategoriesController;
use App\Services\v1\CategoriesService;
use App\Category;

class CategoriesControllerTest extends TestCase
{
    public function testIndex()
    {
        // Mock CategoriesService
        $categoriesServiceMock = $this->getMockBuilder(CategoriesService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of CategoriesController with the mocked CategoriesService
        $controller = new CategoriesController($categoriesServiceMock);

        // Mock a request with input parameters
        $requestMock = $this->getMockBuilder(Request::class)
            ->getMock();
        $requestMock->expects($this->once())
            ->method('input')
            ->willReturn([]);

        // Call the index method on the controller
        $response = $controller->index($requestMock);

        // Assert the response
        $this->assertEquals(200, $response->status());
        // Add more assertions if necessary
    }

    public function testShow()
    {
        // Mock CategoriesService
        $categoriesServiceMock = $this->getMockBuilder(CategoriesService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of CategoriesController with the mocked CategoriesService
        $controller = new CategoriesController($categoriesServiceMock);

        // Mock a request with input parameters
        $requestMock = $this->getMockBuilder(Request::class)
            ->getMock();
        $requestMock->expects($this->once())
            ->method('input')
            ->willReturn([]);

        // Call the show method on the controller
        $response = $controller->show(1, $requestMock);

        // Assert the response
        $this->assertEquals(200, $response->status());
        // Add more assertions if necessary
    }

    public function testStore_ValidationFails()
    {
        // Mock CategoriesService
        $categoriesServiceMock = $this->getMockBuilder(CategoriesService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of CategoriesController with the mocked CategoriesService
        $controller = new CategoriesController($categoriesServiceMock);

        // Mock a request with input parameters that would fail validation
        $requestMock = $this->getMockBuilder(Request::class)
            ->getMock();
        $requestMock->expects($this->once())
            ->method('input')
            ->willReturn(['category_name' => '']);

        // Call the store method on the controller
        $response = $controller->store($requestMock);

        // Assert the response
        $this->assertEquals(400, $response->status());
        // Add more assertions if necessary
    }

    public function testUpdate_ValidationFails()
    {
        // Mock CategoriesService
        $categoriesServiceMock = $this->getMockBuilder(CategoriesService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of CategoriesController with the mocked CategoriesService
        $controller = new CategoriesController($categoriesServiceMock);

        // Mock a request with input parameters that would fail validation
        $requestMock = $this->getMockBuilder(Request::class)
            ->getMock();
        $requestMock->expects($this->once())
            ->method('input')
            ->willReturn(['category_name' => '']);

        // Call the update method on the controller
        $response = $controller->update($requestMock, 1);

        // Assert the response
        $this->assertEquals(400, $response->status());
        // Add more assertions if necessary
    }

    public function testDestroy()
    {
        // Mock CategoriesService
        $categoriesServiceMock = $this->getMockBuilder(CategoriesService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of CategoriesController with the mocked CategoriesService
        $controller = new CategoriesController($categoriesServiceMock);

        // Mock a Category model
        $categoryMock = $this->getMockBuilder(Category::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock a request with input parameters
        $requestMock = $this->getMockBuilder(Request::class)
            ->getMock();

        // Call the destroy method on the controller
        $response = $controller->destroy(1, $requestMock);

        // Assert the response
        $this->assertEquals(200, $response->status());
    }
}
