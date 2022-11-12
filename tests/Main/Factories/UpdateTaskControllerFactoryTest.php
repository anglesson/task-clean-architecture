<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class UpdateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAUpdateTaskController()
    {
        $updateTaskController = new UpdateTaskControllerFactory();
        $this->assertInstanceOf(UpdateTaskController::class, $updateTaskController->create());
    }
}
