<?php

namespace App\ToDo\Application\Presenters\UpdateTask;

use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenter;
use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;

class UpdateTaskPresenterImpl implements UpdateTaskPresenter
{
    public function toJson(OutputUpdateTask $outputUpdateTask): JsonResource
    {
        return new JsonResource($outputUpdateTask->toArray());
    }
}
