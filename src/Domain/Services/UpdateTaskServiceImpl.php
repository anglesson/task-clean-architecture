<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\UpdateTaskService;
use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\FindTaskService;
use Anglesson\Task\Domain\Protocols\UpdateTaskRepository;

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
