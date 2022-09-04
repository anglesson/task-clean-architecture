<?php

namespace Anglesson\Exemplo\test\Application\Api;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Services\CreateTaskService;
use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase {
  public function testShouldCreateTask() {
    $mockRepository = new MockRepository();
    $taskCreateService = new CreateTaskService($mockRepository);
    $task = new Task();
    $task->description = 'Minha tarefa';
    $task->finished = false;
    $taskCriada = $taskCreateService->create($task);
    $this->assertEquals($task, $taskCriada);
  }
}