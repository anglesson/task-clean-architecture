<?php

namespace Anglesson\Task\Infrastructure\Repositories;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Task\Infrastructure\Protocols\UuidGeneratorInterface;
use Anglesson\Task\Domain\Protocols\FindTaskRepositoryInterface;

class MockRepository implements
    CreateTaskRepositoryInterface,
    FindTaskRepositoryInterface
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

    public function findOne(string $idTask): ?Task
    {
        foreach ($this->tasks as $task) {
            if ($task->id === $idTask) {
                return $task;
            }
        }
        return null;
    }
}
