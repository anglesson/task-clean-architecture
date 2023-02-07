<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskService;

class FindTaskServiceImpl implements FindTaskService
{
    private FindTaskRepository $findTaskRepository;

    public function __construct(FindTaskRepository $findTaskRepository)
    {
        $this->findTaskRepository = $findTaskRepository;
    }

    public function find($idTask): Task
    {
        $task = $this->findTaskRepository->findOne($idTask);

        if (!$task) {
            throw new TaskNotFoundException();
        }
        return $task;
    }
}
