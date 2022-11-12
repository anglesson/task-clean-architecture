<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskController()
    {
        $createTaskController = new CreateTaskControllerFactory();
        $this->assertInstanceOf(CreateTaskController::class, $createTaskController->create());
    }
}
