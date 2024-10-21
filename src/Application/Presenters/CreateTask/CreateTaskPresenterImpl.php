<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Infrastructure\Web\Resources\JsonResource;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

class CreateTaskPresenterImpl implements CreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): JsonResource
    {
        return new JsonResource($outputCreateTask->toArray());
    }
}
