<?php

namespace App\ToDo\Domain\UseCases\ListTasks;

use App\ToDo\Domain\Protocols\ITaskRepository;

class ListTasksUseCaseImpl implements ListTasksUseCase
{
    private ITaskRepository $repository;

    public function __construct(ITaskRepository $repository)
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
