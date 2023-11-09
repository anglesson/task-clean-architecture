<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class DeleteTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsADeleteTaskController()
    {
        $repositoryMock = $this->createMock(TaskRepository::class);
        $deleteTaskController = new DeleteTaskControllerFactory();
        $this->assertInstanceOf(DeleteTaskController::class, $deleteTaskController->create($repositoryMock));
    }
}
