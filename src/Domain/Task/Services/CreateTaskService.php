<?php

use Anglesson\Exemplo\Domain\CreateTaskServiceInterface;
use Anglesson\Exemplo\Domain\Task;
use Anglesson\Exemplo\Domain\TaskRepositoryInterface;

class CreateTaskService implements CreateTaskServiceInterface
{
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Task $task): Task
    {
        return $this->repository->save($task);
    }
}