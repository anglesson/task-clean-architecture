<?php

namespace App\ToDo\Application\UseCases\UpdateTask;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;
use App\ToDo\Domain\UseCases\UpdateTask\IUpdateTaskUseCase;

class UpdateTaskServiceImpl implements IUpdateTaskUseCase
{
    protected IFindTaskUseCase $findTaskService;
    protected ITaskRepository $repository;

    public function __construct(IFindTaskUseCase $findTaskService, ITaskRepository $repository)
    {
        $this->findTaskService = $findTaskService;
        $this->repository = $repository;
    }

    public function execute(InputUpdateTask $input): OutputUpdateTask
    {
        $taskFounded = $this->findTaskService->execute($input->id);
        $taskFounded->setDescription($input->description);
        $taskFounded->done();
        $taskUpdated = $this->repository->update($taskFounded);
        return OutputUpdateTask::create($taskUpdated);
    }
}
