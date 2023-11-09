<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

interface ICreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): JsonResource;
}
