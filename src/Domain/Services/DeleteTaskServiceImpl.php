<?php

namespace App\ToDo\Domain\Services;

use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskService;

class DeleteTaskServiceImpl implements DeleteTaskService
{
    private DeleteTaskRepository $repository;
    private FindTaskService $findTaskService;

    public function __construct(DeleteTaskRepository $repository, FindTaskService $findTaskService)
    {
        $this->repository = $repository;
        $this->findTaskService = $findTaskService;
    }

    public function delete(string $idTask): void
    {
        $task = $this->findTaskService->find($idTask);
        $this->repository->delete($task);
    }
}
