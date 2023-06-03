<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class UpdateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAUpdateTaskController()
    {
        $repositoryMock = $this->createMock(ITaskRepository::class);
        $updateTaskController = new UpdateTaskControllerFactory();
        $this->assertInstanceOf(UpdateTaskController::class, $updateTaskController->create($repositoryMock));
    }
}
