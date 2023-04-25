<?php

namespace App\ToDo\Application\UseCases\ListAllTasks;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\ListAllTasks\ListAllTasksService;

class ListAllTasksServiceImpl implements ListAllTasksService
{
    private ITaskRepository $repository;

    public function __construct(ITaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(): array
    {
        $allTasks = $this->repository->list();
        foreach ($allTasks as $task) {
            $todos[] = $task->toArray();
        }
        return $todos ?? [];
    }
}
