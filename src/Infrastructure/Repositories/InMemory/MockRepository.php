<?php

namespace App\ToDo\Infrastructure\Repositories\InMemory;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Infrastructure\Protocols\UuidGenerator;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;

class MockRepository implements
    CreateTaskRepository,
    FindTaskRepository,
    UpdateTaskRepository,
    DeleteTaskRepository
{
    private array $tasks = [];
    private UuidGenerator $generatorId;

    public function __construct(UuidGenerator $generatorId)
    {
        $this->generatorId = $generatorId;
    }

    public function save(Task $task): Task
    {
        $task->setId($this->generatorId->generateId());
        $this->tasks[] = $task;
        return $task;
    }

    public function findOne(string $idTask): ?Task
    {
        foreach ($this->tasks as $task) {
            if ($task->getId() === $idTask) {
                return $task;
            }
        }
        return null;
    }

    public function update(Task $task): Task
    {
        $key = array_search($task, $this->tasks);
        $this->tasks[$key] = $task;
        return $this->tasks[$key];
    }

    public function delete(Task $task): void
    {
        $key = array_search($task, $this->tasks);
        unset($this->tasks[$key]);
    }

    public function getAllTasks()
    {
        return $this->tasks;
    }
}
