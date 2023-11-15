<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use PHPUnit\Framework\TestCase;

class InputCreateTaskTest extends TestCase
{
    public function testShouldBeInstanceOfDataTransferObject()
    {
        $inputCreateTask = InputCreateTask::create([]);
        $this->assertInstanceOf(DataTransferObject::class, $inputCreateTask);
    }

    public function testShouldHaveAtributes()
    {
        $inputCreateTask = InputCreateTask::create([]);
        $this->assertTrue(property_exists($inputCreateTask, 'description'));
    }

    public function testShouldBeReturnAnArrayWithExpectedKeys()
    {
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $this->assertArrayHasKey('description', $inputCreateTask->toArray());
    }

    public function testShouldSetAnyValueToDescription()
    {
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $this->assertEquals('any_description', $inputCreateTask->description);
    }
}
