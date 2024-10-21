<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Infrastructure\Web\Resources\JsonResource;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

interface CreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): JsonResource;
}
