<?php

namespace App\ToDo\Domain\UseCases\ListTasks;

use App\ToDo\Domain\Protocols\TaskRepository;

class ListTasksUseCaseImpl implements ListTasksUseCase
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        $allTasks = $this->repository->list();
        foreach ($allTasks as $task) {
            $todos[] = $task->toArray();
        }
        return $todos ?? [];
    }
}
