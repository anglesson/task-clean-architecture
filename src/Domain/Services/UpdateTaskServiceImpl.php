<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Protocols\UpdateTaskService;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;

class UpdateTaskServiceImpl implements UpdateTaskService
{
    protected FindTaskService $findTaskService;
    protected UpdateTaskRepository $repository;

    public function __construct(FindTaskService $findTaskService, UpdateTaskRepository $repository)
    {
        $this->findTaskService = $findTaskService;
        $this->repository = $repository;
    }

    public function update($idTask, $params): Task
    {
        $taskFounded = $this->findTaskService->find($idTask);
        $taskFounded->fill($params);
        return $this->repository->update($taskFounded);
    }
}
