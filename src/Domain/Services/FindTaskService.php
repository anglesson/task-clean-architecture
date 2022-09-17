<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\FindTaskServiceInterface;
use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\FindTaskRepositoryInterface;
use Anglesson\Task\Domain\Exceptions\TaskNotFoundException;

class FindTaskService implements FindTaskServiceInterface
{
    private FindTaskRepositoryInterface $findTaskRepository;

    public function __construct(FindTaskRepositoryInterface $findTaskRepository)
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
