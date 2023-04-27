<?php

namespace App\ToDo\Application\UseCases\CreateTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
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

    public function execute(InputCreateTask $inputCreateTask): OutputCreateTask
    {
        $this->validation->validate($inputCreateTask->toArray());

        $task = new Task($inputCreateTask->description, $this->uuidGenerator->generateId());
        $createdTask = $this->repository->save($task);
        return OutputCreateTask::create($createdTask);
    }
}
