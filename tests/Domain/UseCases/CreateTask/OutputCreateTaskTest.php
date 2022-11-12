<?php
namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;
use PHPUnit\Framework\TestCase;

class OutputCreateTaskTest extends TestCase
{
    public function testShouldBeInstaceOfDataTransferObject()
    {
        $outputCreateTask = new OutputCreateTask();
        $this->assertInstanceOf(DataTransferObject::class, $outputCreateTask);
    }
}
