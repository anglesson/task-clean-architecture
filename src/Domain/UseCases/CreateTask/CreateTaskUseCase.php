<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;

class CreateTaskUseCase implements ICreateTaskUseCase
{
    private ITaskRepository $repository;
    protected UuidGenerator $uuidGenerator;
    private IValidation $validation;

    public function __construct(ITaskRepository $repository, UuidGenerator $uuidGenerator, IValidation $validation)
    {
        $this->repository = $repository;
        $this->uuidGenerator = $uuidGenerator;
        $this->validation = $validation;
    }

    public function create(InputCreateTask $inputCreateTask): OutputCreateTask
    {
        $this->validation->validate($inputCreateTask->toArray());

        $task = new Task();
        $task->setId($this->uuidGenerator->generateId());
        $task->setDescription($inputCreateTask->description);

        $createdTask = $this->repository->save($task);
        return OutputCreateTask::create($createdTask);
    }
}
