<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\ITaskRepository;

class DeleteTaskServiceImpl implements DeleteTaskService
{
    public function __construct(
        private ITaskRepository $repository
    ) {
    }

    public function delete(string $idTask): void
    {
        $task = $this->repository->findOne($idTask);
        if (!$task) {
            throw new TaskNotFoundException();
        }
        $this->repository->delete($task->getId());
    }
}
