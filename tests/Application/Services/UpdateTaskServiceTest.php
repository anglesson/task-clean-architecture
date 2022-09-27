<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\UpdateTaskServiceImpl;
use Anglesson\Task\Domain\Services\FindTaskServiceImpl;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuidImpl;
use Anglesson\Task\Domain\Services\CreateTaskServiceImpl;
use Psr\Http\Message\ServerRequestInterface;
use Anglesson\Task\Application\DTO\TaskDTO;

class UpdateTaskServiceTest extends TestCase
{
    public function testShouldBeUpdateATask()
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new MockRepository($ramseyUuid);
        $createTaskService = new CreateTaskServiceImpl($repository);
        $findTaskService = new FindTaskServiceImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);

        $requestStub = $this->createStub(ServerRequestInterface::class);
        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description']);
        $taskDTO = TaskDTO::fromRequest($requestStub);

        $task = $createTaskService->create($taskDTO);
        $taskUpdated = $updateTaskService->update($task->getId(), ['description' => 'any_description_updated']);
        $this->assertEquals($taskUpdated->getDescription(), 'any_description_updated');

        $updateTaskService->update($task->getId(), ['finished' => true]);
        $this->assertEquals($task->getFinished(), true);
    }
}
