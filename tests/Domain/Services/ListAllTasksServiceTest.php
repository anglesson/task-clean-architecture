<?php

namespace Test\Domain\Services;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Domain\Services\ListAllTasksServiceImpl;
use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;

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
