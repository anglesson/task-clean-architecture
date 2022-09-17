<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Task\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;
use Anglesson\Task\Application\Utils\TaskMapper;

class CreateTaskService implements CreateTaskServiceInterface
{
    private CreateTaskRepositoryInterface $repository;

    public function __construct(CreateTaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): Task
    {
        $task = TaskMapper::toDomain($data);
        if ($task->finished === true) {
            throw new TaskNotBeCreatedWithStatusFinishedException();
        }
        return $this->repository->save($task);
    }
}
