<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\ListTasksController;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use PHPUnit\Framework\TestCase;

class ListAllTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAListAllTaskController()
    {
        $repositoryMock = $this->createMock(TaskRepository::class);
        $listAllTaskController = new ListAllTasksControllerFactory();
        $this->assertInstanceOf(ListTasksController::class, $listAllTaskController->create($repositoryMock));
    }
}
