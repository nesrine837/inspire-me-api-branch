<?php

namespace Tests\Unit\Providers;

use Illuminate\Support\Facades\Broadcast;
use Tests\TestCase;
use App\User;

class BroadcastServiceProviderTest extends TestCase
{
    public function test_broadcast_routes_are_set_up()
    {
        // Create a mock User object
        $user = factory(User::class)->create();

        // Arrange
        Broadcast::shouldReceive('routes')->once();
        Broadcast::shouldReceive('channel')->andReturnUsing(function ($callback) use ($user) {
            // Act as the authenticated user
            $this->actingAs($user);
        });

        // Act
        $this->app->register(\App\Providers\BroadcastServiceProvider::class);

        // No need to add explicit assertions because Broadcast::shouldReceive()
        // will throw an exception if the 'routes' method is not called as expected.
    }
}
