<?php

namespace Anglesson\Exemplo\tests\Application\Services;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Exemplo\Domain\Services\CreateTaskService;
use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;
use Anglesson\Exemplo\Infrastructure\Utils\RamseyUuid;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase {

    private function makeFakeTask(): Task
    {
        $task = new Task();
        $task->id = 'any_id';
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

    public function testShouldCreateTask() {
        $taskCreateService = $this->makeCreateService();
        $task = $this->makeFakeTask();
        $taskCriada = $taskCreateService->create($task);
        $this->assertEquals($task, $taskCriada);
    }

    public function testShouldCreateANotFinishedTask()
    {
        $task = $this->makeFakeTask();
        $task->finished = true;
        $taskCreated = $this->makeCreateService()->create($task);
        $this->assertEquals(false, $taskCreated->finished);
    }
}