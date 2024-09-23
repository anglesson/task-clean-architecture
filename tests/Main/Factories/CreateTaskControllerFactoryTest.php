<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\CreateTaskController;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskController()
    {
        $repositoryMock = $this->createMock(TaskRepository::class);
        $createTaskController = new CreateTaskControllerFactory();
        $this->assertInstanceOf(CreateTaskController::class, $createTaskController->create($repositoryMock));
    }
}
