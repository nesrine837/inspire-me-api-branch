<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test forgot password functionality.
     */
    public function testForgotPassword()
    {
        // Mocking the mail sending
        Mail::fake();

        // Instantiate the controller
        $controller = new ForgotPasswordController();

        // Create a mock request
        $request = Request::create('/forgot-password', 'POST', ['email' => 'test@example.com']);

        // Call the sendResetLinkEmail method directly
        $response = $controller->sendResetLinkEmail($request);

        // Assert that the response status is 302 (redirect)
        $this->assertEquals(302, $response->status());

        // Additional assertions based on your controller's logic
    }
}
