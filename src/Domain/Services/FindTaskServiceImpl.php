<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\FindTaskService;
use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\FindTaskRepository;
use Anglesson\Task\Domain\Exceptions\TaskNotFoundException;

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
