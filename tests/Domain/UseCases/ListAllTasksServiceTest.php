<?php

namespace Test\Domain\UseCases;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Application\UseCases\FindTask\IFindTaskUseCaseImpl;
use App\ToDo\Application\UseCases\ListAllTasks\IListAllTasksUseCaseImpl;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\UseCases\ListAllTasks\ListAllTasksRepository;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class ListAllTasksServiceTest extends TestCase
{
    public function makeService(): array
    {
        $repository = new MockRepository();
        $createTaskService = new CreateTaskUseCase($repository, new RamseyUuidImpl());
        $findTaskService = new IFindTaskUseCaseImpl($repository);
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

        $service = new IListAllTasksUseCaseImpl($repository);
        $tasks = $service->execute();
        $this->assertIsArray($tasks);
        $this->assertCount(3, $tasks);
    }
}
