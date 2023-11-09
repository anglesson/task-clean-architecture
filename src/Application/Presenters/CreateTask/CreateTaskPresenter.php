<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

class CreateTaskPresenter implements ICreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): JsonResource
    {
        return new JsonResource($outputCreateTask->toArray());
    }
}
