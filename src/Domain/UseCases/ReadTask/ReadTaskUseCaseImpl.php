<?php

namespace App\ToDo\Domain\UseCases\ReadTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

class ReadTaskUseCaseImpl implements ReadTaskUseCase
{
    private ITaskRepository $repository;

    public function __construct(ITaskRepository $findTaskRepository)
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
