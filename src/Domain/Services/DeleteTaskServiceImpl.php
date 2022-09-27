<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\DeleteTaskService;
use Anglesson\Task\Domain\Protocols\DeleteTaskRepository;
use Anglesson\Task\Domain\Protocols\FindTaskService;

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
