<?php

namespace Anglesson\Exemplo\Domain\Services;

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskServiceInterface;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskRepositoryInterface;
use function PHPUnit\Framework\throwException;

class CreateTaskService implements CreateTaskServiceInterface
{
    private CreateTaskRepositoryInterface $repository;

    public function __construct(CreateTaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Task $task): Task
    {
        $task->finished = false;
        return $this->repository->save($task);
    }
}
