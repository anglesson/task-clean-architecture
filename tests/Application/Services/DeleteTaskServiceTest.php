<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\FindTaskService;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use Anglesson\Task\Domain\Services\CreateTaskService;
use Anglesson\Task\Domain\Services\DeleteTaskService;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\DeleteTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\DeleteTaskRepositoryInterface;
use Anglesson\Task\Domain\Protocols\FindTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Task\Domain\Protocols\FindTaskRepositoryInterface;
use Anglesson\Task\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;

class DeleteTaskServiceTest extends TestCase
{
    private $repository;

    private DeleteTaskService $deleteService;

    private CreateTaskService $createTaskService;

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
        $ramseyUuid = new RamseyUuid();
        return new MockRepository($ramseyUuid);
    }

    public function findTaskServiceFactory(FindTaskRepositoryInterface $repository)
    {
        return new FindTaskService($repository);
    }


    public function createTaskServiceFactory(CreateTaskRepositoryInterface $repository): CreateTaskServiceInterface
    {
        return new CreateTaskService($repository);
    }

    public function deleteTaskServiceFactory(
        DeleteTaskRepositoryInterface $repository,
        FindTaskServiceInterface $findTaskService
    ): DeleteTaskServiceInterface {
        return new DeleteTaskService($repository, $findTaskService);
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
