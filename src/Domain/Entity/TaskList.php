<?php

namespace App\ToDo\Domain\Entity;

class TaskList extends Entity
{
    private string $name;
    private array $tasks;

    public function __construct(string $name, array $tasks = [])
    {
        $this->name = $name;
        $this->tasks = $tasks;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function add(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function remove(Task $task): void
    {
        $key = array_search($task, $this->tasks);
        array_splice($this->tasks, $key, 1);
    }

    public function rename(string $name): void
    {
        $this->name = $name;
    }
}