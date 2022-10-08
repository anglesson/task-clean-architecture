<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;
use App\ToDo\Application\DTO\TaskDTO;

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
