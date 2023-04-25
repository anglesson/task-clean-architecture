<?php

namespace App\ToDo\Infrastructure\Repositories\InMemory;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\FindTaskRepository;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskRepository;

class MockRepository implements
    FindTaskRepository,
    UpdateTaskRepository,
    ITaskRepository
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

    public function getAllTasks()
    {
        return $this->tasks;
    }
}
