<?php

namespace Anglesson\Task\Domain\Services;

use Anglesson\Task\Domain\Protocols\DeleteTaskServiceInterface;
use Anglesson\Task\Domain\Protocols\DeleteTaskRepositoryInterface;
use Anglesson\Task\Domain\Protocols\FindTaskServiceInterface;

class DeleteTaskService implements DeleteTaskServiceInterface
{
    private DeleteTaskRepositoryInterface $repository;
    private FindTaskServiceInterface $findTaskService;

    public function __construct(DeleteTaskRepositoryInterface $repository, FindTaskServiceInterface $findTaskService)
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
