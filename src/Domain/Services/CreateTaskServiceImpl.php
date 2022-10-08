<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\InvalidParamError;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Exceptions\TaskNotBeCreatedWithStatusFinishedException;
use App\ToDo\Application\DTO\TaskDTO;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\Protocols\UuidGenerator;

class CreateTaskServiceImpl implements CreateTaskService
{
    private CreateTaskRepository $repository;
    protected UuidGenerator $uuidGenerator;
    public function __construct(CreateTaskRepository $repository, UuidGenerator $uuidGenerator)
    {
        $this->repository = $repository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function create(TaskDTO $taskDTO): Task
    {
        if ($taskDTO->finished === true) {
            throw new TaskNotBeCreatedWithStatusFinishedException();
        }

        if (!$taskDTO->description) {
            throw new MissingParamsError('description');
        }

        $task = new Task();
        $task->setId($this->uuidGenerator->generateId());
        $task->setDescription($taskDTO->description);

        return $this->repository->save($task);
    }
}
