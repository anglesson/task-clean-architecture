<?php

namespace Anglesson\Exemplo\Infrastructure\Repositories;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Protocols\TaskRepositoryInterface;

class MockRepository implements TaskRepositoryInterface {
  private array $tasks = [];
  public function save(Task $tarefa): Task
  {
    $this->tasks[] = $tarefa;
    return $tarefa;
  }
}