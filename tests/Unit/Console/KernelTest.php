<?php

namespace Tests\Unit\Console;

use App\Console\Kernel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Testing\TestCase;
use Tests\TestCase as BaseTestCase;

class KernelTest extends BaseTestCase
{
    /**
     * Test that the schedule method is indirectly invoked.
     *
     * @return void
     */
    public function testScheduleMethodIsIndirectlyInvoked()
    {
        // Mock the Schedule instance
        $schedule = $this->getMockBuilder(Schedule::class)
                         ->getMock();

        // Mock the Dispatcher interface
        $dispatcher = $this->getMockBuilder(Dispatcher::class)
                           ->getMock();

        // Create an instance of the Kernel
        $kernel = new TestableKernel($this->app, $dispatcher);

        // Call the method that indirectly invokes the schedule method
        $result = $kernel->performScheduling($schedule);

        // Assert that the result is not null and is an instance of Kernel
        $this->assertInstanceOf(Kernel::class, $result);
    }
}

/**
 * A subclass of the Kernel class to expose protected methods for testing.
 */
class TestableKernel extends Kernel
{
    /**
     * A method that indirectly invokes the schedule method.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return \App\Console\Kernel
     */
    public function performScheduling(Schedule $schedule)
    {
        // Call the protected schedule method indirectly
        $this->schedule($schedule);

        // Return an instance of Kernel
        return $this;
    }
}
