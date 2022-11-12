<?php

namespace Test\Domain\UseCases;

use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Domain\UseCases\DeleteTaskServiceImpl;
use App\ToDo\Domain\UseCases\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class DeleteTaskServiceTest extends TestCase
{
    private $repository;

    private DeleteTaskServiceImpl $deleteService;

    private CreateTaskUseCase $createTaskService;

    public function setUp(): void
    {
        $this->repository = $this->mockRepositoryFactory();
        $this->createTaskService = $this->createTaskServiceFactory($this->repository, new RamseyUuidImpl);
        $this->deleteService = $this->deleteTaskServiceFactory(
            $this->repository,
            $this->findTaskServiceFactory($this->repository)
        );
    }

    public function mockRepositoryFactory(): MockRepository
    {
        return new MockRepository();
    }

    public function findTaskServiceFactory(FindTaskRepository $repository)
    {
        return new FindTaskServiceImpl($repository);
    }


    public function createTaskServiceFactory(
        CreateTaskRepository $repository,
        UuidGenerator $uuidGenerator
    ): ICreateTaskUseCase {
        return new CreateTaskUseCase($repository, $uuidGenerator);
    }

    public function deleteTaskServiceFactory(
        DeleteTaskRepository $repository,
        FindTaskService $findTaskService
    ): DeleteTaskService {
        return new DeleteTaskServiceImpl($repository, $findTaskService);
    }

    public function testShouldBeDeleteATaskById()
    {
        $data = ['description' => 'any_description'];
        $inputCreateTask = new InputCreateTask($data);

        $task1 = $this->createTaskService->create($inputCreateTask);
        $task2 = $this->createTaskService->create($inputCreateTask);
        $task3 = $this->createTaskService->create($inputCreateTask);

        $this->assertEquals(3, count($this->repository->getAllTasks()));

        $this->deleteService->delete($task1->getId());
        $this->deleteService->delete($task2->getId());
        $this->deleteService->delete($task3->getId());
        $this->assertEquals(0, count($this->repository->getAllTasks()));
    }
}
