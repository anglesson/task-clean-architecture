<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;

class CreateTaskPresenter implements ICreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): string
    {
        return JsonResource::create($outputCreateTask);
    }
}
