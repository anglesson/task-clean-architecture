<?php

namespace App\ToDo\Application\UseCases\DeleteTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskService;

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
