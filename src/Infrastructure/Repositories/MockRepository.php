<?php

namespace Anglesson\Task\Infrastructure\Repositories;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Task\Infrastructure\Protocols\UuidGeneratorInterface;

class MockRepository implements CreateTaskRepositoryInterface
{
    private array $tasks = [];
    private UuidGeneratorInterface $generatorId;

    public function __construct(UuidGeneratorInterface $generatorId)
    {
        $this->generatorId = $generatorId;
    }

    public function save(Task $task): Task
    {
        $task->id = $this->generatorId->generateId();
        $this->tasks[] = $task;
        return $task;
    }
}
