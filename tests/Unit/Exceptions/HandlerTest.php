<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

class HandlerTest extends TestCase
{
    /**
     * Test rendering a ModelNotFoundException.
     *
     * @return void
     */
    public function testRenderModelNotFoundException()
    {
        // Mock Request class
        $request = Mockery::mock(Request::class);

        // Mock Container
        $container = Mockery::mock('Illuminate\Contracts\Container\Container');

        $handler = new Handler($container);
        $exception = new ModelNotFoundException();

        $response = $handler->render($request, $exception);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('{"error":"Resource item not found."}', $response->getContent());
    }

    /**
     * Test rendering other exceptions.
     *
     * @return void
     */
    public function testRenderOtherExceptions()
    {
        // Mock Request class
        $request = Mockery::mock(Request::class);

        // Mock Container
        $container = Mockery::mock('Illuminate\Contracts\Container\Container');

        $handler = new Handler($container);
        $exception = new \Exception('Test exception message');

        // Mock Log facade
        Log::shouldReceive('error')->once()->with('Test exception message');

        $response = $handler->render($request, $exception);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('{"error":"An error has occurred."}', $response->getContent());
    }

    /**
     * Clean up mockery
     */
    public function tearDown(): void
    {
        Mockery::close();
    }
}
