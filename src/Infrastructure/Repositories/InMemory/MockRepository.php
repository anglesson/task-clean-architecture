<?php

namespace App\ToDo\Infrastructure\Repositories\InMemory;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;

class MockRepository implements
    CreateTaskRepository,
    FindTaskRepository,
    UpdateTaskRepository,
    DeleteTaskRepository
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
