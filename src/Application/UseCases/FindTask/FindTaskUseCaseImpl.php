<?php

namespace App\ToDo\Application\UseCases\FindTask;

use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;

class FindTaskUseCaseImpl implements IFindTaskUseCase
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
