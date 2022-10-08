<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;

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
