<?php

namespace App\ToDo\Domain\UseCases\ReadTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

class ReadTaskUseCaseImpl implements ReadTaskUseCase
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $findTaskRepository)
    {
        $this->repository = $findTaskRepository;
    }

    public function execute($idTask): OutputCreateTask
    {
        $task = $this->repository->findOne($idTask);

        if (!$task) {
            throw new TaskNotFoundException();
        }
        return new OutputCreateTask($task->toArray());
    }
}
