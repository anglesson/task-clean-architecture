<?php

namespace Test\Domain\Services;

use PHPUnit\Framework\TestCase;
use App\ToDo\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Domain\Services\DeleteTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;

class DeleteTaskServiceTest extends TestCase
{
    private $repository;

    private DeleteTaskServiceImpl $deleteService;

    private CreateTaskServiceImpl $createTaskService;

    public function setUp(): void
    {
        $this->repository = $this->mockRepositoryFactory();
        $this->createTaskService = $this->createTaskServiceFactory($this->repository);
        $this->deleteService = $this->deleteTaskServiceFactory(
            $this->repository,
            $this->findTaskServiceFactory($this->repository)
        );
    }

    public function mockRepositoryFactory(): MockRepository
    {
        $ramseyUuid = new RamseyUuidImpl();
        return new MockRepository($ramseyUuid);
    }

    public function findTaskServiceFactory(FindTaskRepository $repository)
    {
        return new FindTaskServiceImpl($repository);
    }


    public function createTaskServiceFactory(CreateTaskRepository $repository): CreateTaskService
    {
        return new CreateTaskServiceImpl($repository);
    }

    public function deleteTaskServiceFactory(
        DeleteTaskRepository $repository,
        FindTaskService $findTaskService
    ): DeleteTaskService {
        return new DeleteTaskServiceImpl($repository, $findTaskService);
    }

    public function testShouldBeDeleteATaskById()
    {
        $requestStub = $this->createStub(ServerRequestInterface::class);
        
        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description_1']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        $task1 = $this->createTaskService->create($taskDTO);

        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description_1']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        $task2 = $this->createTaskService->create($taskDTO);

        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description_1']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        $task3 = $this->createTaskService->create($taskDTO);
        $this->assertEquals(3, count($this->repository->getAllTasks()));

        $this->deleteService->delete($task1->getId());
        $this->deleteService->delete($task2->getId());
        $this->deleteService->delete($task3->getId());
        $this->assertEquals(0, count($this->repository->getAllTasks()));
    }
}
