<?php

namespace App\ToDo\Application\UseCases\ListAllTasks;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\ListAllTasks\IListAllTasksUseCase;

class IListAllTasksUseCaseImpl implements IListAllTasksUseCase
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
