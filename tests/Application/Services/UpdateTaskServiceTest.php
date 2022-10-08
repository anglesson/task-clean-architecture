<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use App\ToDo\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Domain\Services\UpdateTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\MockRepository;

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
