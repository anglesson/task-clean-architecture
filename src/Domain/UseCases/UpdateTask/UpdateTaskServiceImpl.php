<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\Protocols\FindTaskService;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;
use App\ToDo\Domain\Protocols\UpdateTaskService;
use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;

class UpdateTaskServiceImpl implements UpdateTaskService
{
    protected FindTaskService $findTaskService;
    protected UpdateTaskRepository $repository;

    public function __construct(FindTaskService $findTaskService, UpdateTaskRepository $repository)
    {
        $this->findTaskService = $findTaskService;
        $this->repository = $repository;
    }

    public function update(InputUpdateTask $input): OutputUpdateTask
    {
        $taskFounded = $this->findTaskService->find($input->id);
        $taskFounded->setDescription($input->description);
        $taskFounded->setFinished($input->finished);
        $taskUpdated = $this->repository->update($taskFounded);
        return OutputUpdateTask::create($taskUpdated);
    }
}
