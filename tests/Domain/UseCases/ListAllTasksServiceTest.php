<?php

namespace Test\Domain\UseCases;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskServiceImpl;
use App\ToDo\Domain\UseCases\FindTaskServiceImpl;
use App\ToDo\Domain\UseCases\ListAllTasksServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class ListAllTasksServiceTest extends TestCase
{
    public function makeService(): array
    {
        $repository = new MockRepository();
        $createTaskService = new CreateTaskServiceImpl($repository, new RamseyUuidImpl());
        $findTaskService = new FindTaskServiceImpl($repository);
        return array($createTaskService, $findTaskService);
    }

    public function testShouldListAllTasks()
    {
        $repository = $this->createStub(ListAllTasksRepository::class);

        $repository->method('list')->willReturn([
            $this->createMock(Task::class),
            $this->createMock(Task::class),
            $this->createMock(Task::class),
        ]);

        $service = new ListAllTasksServiceImpl($repository);
        $tasks = $service->list();
        $this->assertIsArray($tasks);
        $this->assertCount(3, $tasks);
    }
}
