<?php

namespace App\ToDo\Application\UseCases\UpdateTask;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\FindTaskService;
use App\ToDo\Domain\UseCases\UpdateTask\IUpdateTaskUseCase;

class UpdateTaskServiceImpl implements IUpdateTaskUseCase
{
    protected FindTaskService $findTaskService;
    protected ITaskRepository $repository;

    public function __construct(FindTaskService $findTaskService, ITaskRepository $repository)
    {
        $this->findTaskService = $findTaskService;
        $this->repository = $repository;
    }

    public function update(InputUpdateTask $input): OutputUpdateTask
    {
        $taskFounded = $this->findTaskService->find($input->id);
        $taskFounded->setDescription($input->description);
        $taskFounded->done();
        $taskUpdated = $this->repository->update($taskFounded);
        return OutputUpdateTask::create($taskUpdated);
    }
}
