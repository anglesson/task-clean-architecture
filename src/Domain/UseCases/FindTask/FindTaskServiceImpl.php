<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Protocols\ITaskRepository;

class FindTaskServiceImpl implements FindTaskService
{
    private ITaskRepository $repository;

    public function __construct(ITaskRepository $findTaskRepository)
    {
        $this->repository = $findTaskRepository;
    }

    public function find($idTask): Task
    {
        $task = $this->repository->findOne($idTask);

        if (!$task) {
            throw new TaskNotFoundException();
        }
        return $task;
    }
}
