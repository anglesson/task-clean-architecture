<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\Utils\Validators\IValidation;

class CreateTaskUseCaseImpl implements CreateTaskUseCase
{
    private TaskRepository $repository;
    private IValidation $validation;
    private UuidGenerator $uuidGenerator;

    public function __construct(
        TaskRepository $repository,
        UuidGenerator $uuidGenerator,
        IValidation $validation,
    ) {
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
