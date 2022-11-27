<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;

class CreateTaskUseCase implements ICreateTaskUseCase
{
    private CreateTaskRepository $repository;
    protected UuidGenerator $uuidGenerator;

    public function __construct(CreateTaskRepository $repository, UuidGenerator $uuidGenerator)
    {
        $this->repository = $repository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function create(InputCreateTask $inputCreateTask): OutputCreateTask
    {
        if (!$inputCreateTask->description) {
            throw new MissingParamsError('description');
        }

        $task = new Task();
        $task->setId($this->uuidGenerator->generateId());
        $task->setDescription($inputCreateTask->description);

        $createdTask = $this->repository->save($task);
        return OutputCreateTask::create($createdTask);
    }
}
