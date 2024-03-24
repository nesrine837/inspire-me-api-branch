<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;

class KernelTest extends TestCase
{
    /**
     * Test Kernel instantiation with all required parameters.
     *
     * @return void
     */
    public function testKernelInstantiation()
    {
        // Mock Application, Dispatcher, and Router instances
        $app = $this->createMock(Application::class);
        $dispatcher = $this->createMock(Dispatcher::class);
        $router = new Router($dispatcher);

        // Create instance of Kernel
        $kernel = new Kernel($app, $router);

        // Assert that Kernel instance is not null
        $this->assertNotNull($kernel);
    }

    /**
     * Test global HTTP middleware stack.
     *
     * @return void
     */
    public function testGlobalMiddlewareStack()
    {
        // Mock Application to return an array when accessed
        $app = $this->createMock(Application::class);
        $app->method('offsetGet')->willReturn([]);

        // Mock Dispatcher and Router instances
        $dispatcher = $this->createMock(Dispatcher::class);
        $router = new Router($dispatcher);

        // Create instance of Kernel
        $kernel = new Kernel($app, $router);

        // Get the middleware stack via middleware method
        $middleware = $kernel->middleware();

        // Define expected middleware classes
        $expectedMiddleware = [
            \App\Http\Middleware\CheckForMaintenanceMode::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \App\Http\Middleware\TrustProxies::class,
        ];

        // Assert that the middleware stack matches the expected middleware
        $this->assertEquals($expectedMiddleware, $middleware);
    }
}
