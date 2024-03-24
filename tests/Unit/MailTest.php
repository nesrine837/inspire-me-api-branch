<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Mail\NewProject;

class NewProjectTest extends TestCase
{
    /**
     * Test constructor sets properties correctly.
     *
     * @return void
     */
    public function testConstructorSetsProperties()
    {
        $info = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message.',
            'cell' => '1234567890',
        ];

        $newProject = new NewProject($info);

        $this->assertEquals('John Doe', $newProject->name);
        $this->assertEquals('john@example.com', $newProject->email);
        $this->assertEquals('This is a test message.', $newProject->content);
        $this->assertEquals('1234567890', $newProject->cell);
    }

    /**
     * Test build method returns a Mailable instance.
     *
     * @return void
     */
    public function testBuildMethodReturnsMailableInstance()
    {
        $info = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message.',
            'cell' => '1234567890',
        ];

        $newProject = new NewProject($info);
        $buildResult = $newProject->build();

        $this->assertInstanceOf(\Illuminate\Mail\Mailable::class, $buildResult);
    }
}
