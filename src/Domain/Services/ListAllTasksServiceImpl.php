<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Domain\Protocols\ListAllTasksService;

class ListAllTasksServiceImpl implements ListAllTasksService
{

    public function __construct(
        private readonly ListAllTasksRepository $repository
    ) {
    }

    public function list(): array
    {
        $allTasks = $this->repository->list();
        foreach ($allTasks as $task) {
            $todos[] = $task->toArray();
        }
        return $todos;
    }
}
