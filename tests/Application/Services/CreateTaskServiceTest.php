<?php

namespace Anglesson\Task\tests\Application\Services;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Task\Domain\Services\CreateTaskService;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;

class CreateTaskServiceTest extends TestCase
{

    private function makeFakeTask(): Task
    {
        $task = new Task();
        $task->description = 'Any Task';
        $task->finished = false;
        return $task;
    }

    private function makeCreateService(): CreateTaskServiceInterface
    {
        $mockUuid = new RamseyUuid();
        $mockRepository = new MockRepository($mockUuid);
        return new CreateTaskService($mockRepository);
    }

    public function testShouldCreateTask()
    {
        $taskCreateService = $this->makeCreateService();
        $task = $this->makeFakeTask();
        $taskCriada = $taskCreateService->create($task);
        $this->assertEquals($task, $taskCriada);
    }

    public function testShouldThrowsExceptionIfTaskWillBeCreatedWithStatusFinishedTrue()
    {
        $this->expectException(TaskNotBeCreatedWithStatusFinishedException::class);
        $task = $this->makeFakeTask();
        $task->finished = true;
        $taskCreated = $this->makeCreateService()->create($task);
    }
}
