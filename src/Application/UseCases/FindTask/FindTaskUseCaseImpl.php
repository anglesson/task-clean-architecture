<?php

namespace App\ToDo\Application\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;

class IFindTaskUseCaseImpl implements IFindTaskUseCase
{
    private ITaskRepository $repository;

    public function __construct(ITaskRepository $findTaskRepository)
    {
        $this->repository = $findTaskRepository;
    }

    public function execute($idTask): Task
    {
        $task = $this->repository->findOne($idTask);

        if (!$task) {
            throw new TaskNotFoundException();
        }
        return $task;
    }
}
