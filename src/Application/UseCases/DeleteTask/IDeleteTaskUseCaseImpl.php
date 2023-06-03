<?php

namespace App\ToDo\Application\UseCases\DeleteTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\IDeleteTaskUseCase;

class IDeleteTaskUseCaseImpl implements IDeleteTaskUseCase
{
    public function __construct(
        private readonly ITaskRepository $repository
    ) {
    }

    public function execute(string $idTask): void
    {
        $task = $this->repository->findOne($idTask);
        if (!$task) {
            throw new TaskNotFoundException();
        }
        $this->repository->delete($task->getId());
    }
}
