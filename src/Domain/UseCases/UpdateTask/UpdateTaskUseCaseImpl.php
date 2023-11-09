<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\TaskRepository;

class UpdateTaskUseCaseImpl implements UpdateTaskUseCase
{
    protected TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(InputUpdateTask $input): OutputUpdateTask
    {
        $taskFounded = $this->repository->findOne($input->id);
        if (!$taskFounded) {
            throw new TaskNotFoundException();
        }
        $taskFounded->updateDescription($input->description);
        $taskFounded->done();
        $taskUpdated = $this->repository->update($taskFounded);
        return OutputUpdateTask::create($taskUpdated);
    }
}
