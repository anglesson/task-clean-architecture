<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;
use PHPUnit\Framework\TestCase;

class OutputCreateTaskTest extends TestCase
{
    public function testShouldBeInstaceOfDataTransferObject()
    {
        $outputCreateTask = new OutputCreateTask();
        $this->assertInstanceOf(DataTransferObject::class, $outputCreateTask);
    }

    public function testShouldReturnsAnArrayWithExpectedValues()
    {
        $task = new Task('any_description', 'any_id');

        $outputCreateTask = OutputCreateTask::create($task);

        $this->assertNotNull($outputCreateTask->id);
        $this->assertEquals('any_description', $outputCreateTask->description);
        $this->assertIsBool($outputCreateTask->finished);
    }
}
