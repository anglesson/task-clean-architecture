<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\UpdateTaskController;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class UpdateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAUpdateTaskController()
    {
        $repositoryMock = $this->createMock(TaskRepository::class);
        $updateTaskController = new UpdateTaskControllerFactory();
        $this->assertInstanceOf(UpdateTaskController::class, $updateTaskController->create($repositoryMock));
    }
}
