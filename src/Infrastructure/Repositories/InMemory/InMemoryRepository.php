<?php

namespace App\ToDo\Infrastructure\Repositories\InMemory;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;

class InMemoryRepository implements ITaskRepository
{
    private array $tasks = [];

    public function save(Task $task): Task
    {
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

    public function delete(string $idTask): void
    {
        $key = array_search($idTask, $this->tasks);
        unset($this->tasks[$key]);
    }

    public function list(): array
    {
        return $this->tasks;
    }
}
