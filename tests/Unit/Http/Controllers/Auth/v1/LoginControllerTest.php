<?php

namespace Tests\Unit\Http\Controllers\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the login controller redirects authenticated users to the home route.
     *
     * @return void
     */
    public function test_authenticated_users_redirected_to_home()
    {
        // Mock authentication
        $this->actingAs(factory(\App\User::class)->create());

        // Make a request to the login controller
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        // Assert redirection
        $response->assertRedirect('/home');
    }

    /**
     * Test if the login controller allows guest users to access the login page.
     *
     * @return void
     */
    public function test_guest_users_can_access_login_page()
    {
        // Make a request to the login page
        $response = $this->get('/login');

        // Assert status code 200 (OK)
        $response->assertStatus(200);
    }

    /**
     * Test if the login controller uses the guest middleware except for the logout route.
     *
     * @return void
     */
    public function test_guest_middleware_except_logout()
    {
        // Get the login controller routes
        $loginControllerRoutes = collect(Route::getRoutes())->filter(function ($route) {
            return strpos($route->uri, 'login') !== false;
        });

        // Assert that the middleware 'guest' is applied to all routes except 'logout'
        foreach ($loginControllerRoutes as $route) {
            if (strpos($route->uri, 'logout') !== false) {
                $this->assertArrayNotHasKey('guest', $route->middleware());
            } else {
                $this->assertContains('guest', $route->middleware());
            }
        }
    }
}
