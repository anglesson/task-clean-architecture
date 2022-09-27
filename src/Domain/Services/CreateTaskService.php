<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\CreateTaskRepositoryInterface;
use Anglesson\Task\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;
use Anglesson\Task\Application\Utils\TaskMapper;
use Anglesson\Task\Application\DTO\TaskDTO;

class CreateTaskService implements CreateTaskServiceInterface
{
    private CreateTaskRepositoryInterface $repository;

    public function __construct(CreateTaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(TaskDTO $taskDTO): Task
    {
        if ($taskDTO->finished === true) {
            throw new TaskNotBeCreatedWithStatusFinishedException();
        }

        $task = new Task();
        $task->setDescription($taskDTO->description);

        return $this->repository->save($task);
    }
}
