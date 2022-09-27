<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\FindTaskServiceImpl;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuidImpl;
use Anglesson\Task\Domain\Services\CreateTaskServiceImpl;
use Anglesson\Task\Domain\Services\DeleteTaskServiceImpl;
use Anglesson\Task\Domain\Protocols\CreateTaskService;
use Anglesson\Task\Domain\Protocols\DeleteTaskService;
use Anglesson\Task\Domain\Protocols\DeleteTaskRepository;
use Anglesson\Task\Domain\Protocols\FindTaskService;
use Anglesson\Task\Domain\Protocols\CreateTaskRepository;
use Anglesson\Task\Domain\Protocols\FindTaskRepository;
use Anglesson\Task\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;

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
