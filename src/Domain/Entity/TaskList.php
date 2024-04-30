<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Core\Collection;

class TaskList extends Entity
{
    private string $name;

    /** @var Collection<Task> $tasks */
    private Collection $tasks;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tasks = new Collection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** 
     * @return Collection<Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function add(Task $task): void
    {
        $this->tasks->offsetSet(null, $task);
    }

    public function remove(Task $task): void
    {
        $this->tasks->remove($task);
    }

    public function rename(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
