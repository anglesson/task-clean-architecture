<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\CreateTaskListController;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Main\Factories\CreateTaskListControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskListControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskListController()
    {
        $createTaskListController = new CreateTaskListControllerFactory();
        $taskListRepository = $this->createMock(TaskListRepository::class);
        $this->assertInstanceOf(CreateTaskListController::class, $createTaskListController->create($taskListRepository));
    }
}
