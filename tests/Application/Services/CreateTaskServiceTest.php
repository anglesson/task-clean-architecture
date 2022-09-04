<?php

namespace Anglesson\Exemplo\test\Application\Services;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Services\CreateTaskService;
use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;
use Anglesson\Exemplo\Infrastructure\Utils\RamseyUuid;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase {
  public function testShouldCreateTask() {
    $mockUuid = new RamseyUuid();
    $mockRepository = new MockRepository($mockUuid);
    $taskCreateService = new CreateTaskService($mockRepository);
    $task = new Task();
    $task->description = 'Minha tarefa';
    $task->finished = false;
    $taskCriada = $taskCreateService->create($task);
    $this->assertEquals($task, $taskCriada);
  }
}