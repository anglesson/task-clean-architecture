<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;

class UpdateTaskUseCaseImpl implements UpdateTaskUseCase
{
    protected ITaskRepository $repository;

    public function __construct(ITaskRepository $repository)
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
