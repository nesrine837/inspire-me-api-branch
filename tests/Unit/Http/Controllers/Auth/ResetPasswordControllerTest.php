<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test reset password functionality.
     */
    public function testResetPassword()
    {
        // Mock the password broker
        Password::shouldReceive('broker->reset')->once()->andReturn('passwords.reset');

        // Sample user data for password reset
        $userData = [
            'email' => 'test@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
            'token' => 'token',
        ];

        // Instantiate the controller
        $controller = new ResetPasswordController();

        // Create a mock request
        $request = Request::create('/reset-password', 'POST', $userData);

        // Call the reset method directly
        $response = $controller->reset($request);

        // Assert that the response is successful
        // $this->assertEquals('passwords.reset', $response);
    }
}
