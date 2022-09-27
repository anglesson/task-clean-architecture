<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Protocols\CreateTaskService;
use Anglesson\Task\Domain\Protocols\CreateTaskRepository;
use Anglesson\Task\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;
use Anglesson\Task\Application\DTO\TaskDTO;

class CreateTaskServiceImpl implements CreateTaskService
{
    private CreateTaskRepository $repository;

    public function __construct(CreateTaskRepository $repository)
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
