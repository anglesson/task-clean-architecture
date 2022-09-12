<?php

namespace Anglesson\Exemplo\Domain\Services;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Exemplo\Domain\Errors\TaskNotBeCreatedWithStatusFinishedException;

class CreateTaskService implements CreateTaskServiceInterface
{
    private CreateTaskRepositoryInterface $repository;

    public function __construct(CreateTaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Task $task): Task
    {
        if($task->finished === true) {
            throw new TaskNotBeCreatedWithStatusFinishedException();
        }
        return $this->repository->save($task);
    }
}
