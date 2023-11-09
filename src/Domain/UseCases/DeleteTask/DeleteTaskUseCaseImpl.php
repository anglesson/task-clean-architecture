<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\TaskRepository;

class DeleteTaskUseCaseImpl implements DeleteTaskUseCase
{
    public function __construct(
        private readonly TaskRepository $repository
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
