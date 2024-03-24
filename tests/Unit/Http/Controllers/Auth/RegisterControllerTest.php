<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {
        // Mock the Validator facade
        Validator::shouldReceive('make')->andReturn(true); // Mock a successful validation

        // Mock the User model create method
        $userMock = $this->getMockBuilder(User::class)
            ->getMock();
        $userMock->expects($this->once())
            ->method('create')
            ->willReturn(true); // Mock a successful user creation

        // Bind the mocked User model instance to the app container
        $this->app->instance(User::class, $userMock);

        // Instantiate the controller
        $controller = new RegisterController();

        // Create a mock request with necessary data
        $request = Request::create('/register', 'POST', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Call the register method directly
        $response = $controller->register($request);

        // Assert that the user was successfully registered
        $this->assertEquals('success', $response->getContent()); // Assuming success response
    }
}
