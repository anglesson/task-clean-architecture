<?php

namespace Test\Domain\Services\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Services\CreateTask\InputCreateTask;
use PHPUnit\Framework\TestCase;

class InputCreateTaskTest extends TestCase
{
    public function testShouldBeInstaceOfDataTransferObject()
    {
        $inputCreateTask = new InputCreateTask();
        $this->assertInstanceOf(DataTransferObject::class, $inputCreateTask);
    }

    public function testShouldHaveAtributes()
    {
        $inputCreateTask = new InputCreateTask();
        $this->assertTrue(property_exists($inputCreateTask, 'description'));
    }

    public function testShoulBeReturnAnArrayWithExpectedKeys()
    {
        $inputCreateTask = new InputCreateTask();
        $this->assertTrue(key_exists('description', $inputCreateTask->toArray()));
    }

    public function testShouldSetAnyValueToDescription()
    {
        $inputCreateTask = new InputCreateTask(['description' => 'any_description']);
        $this->assertEquals('any_description', $inputCreateTask->description);
    }
}
