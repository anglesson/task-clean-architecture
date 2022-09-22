<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\UpdateTaskServiceInterface;
use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\FindTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\UpdateTaskRepositoryInterface;

class UpdateTaskService implements UpdateTaskServiceInterface
{
    protected FindTaskServiceInterface $findTaskService;
    protected UpdateTaskRepositoryInterface $repository;

    public function __construct(FindTaskServiceInterface $findTaskService, UpdateTaskRepositoryInterface $repository)
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
