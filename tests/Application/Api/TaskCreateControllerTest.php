<?php

namespace Anglesson\Task\tests\Application\Api;

use PHPUnit\Framework\TestCase;

class TaskCreateControllerTest extends TestCase
{
    public function testShouldBeCallActionWithCorrectValues()
    {
        $task = new Task();
        $task->
        $stub = $this->createStub(TaskCreateController::class);
        $stub->method('handle')
            ->willReturn('handle');
        $this->assertEquals();
    }
}
