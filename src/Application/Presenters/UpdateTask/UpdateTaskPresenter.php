<?php

namespace App\ToDo\Application\Presenters\UpdateTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;

interface UpdateTaskPresenter
{
    public function toJson(OutputUpdateTask $outputUpdateTask): JsonResource;
}
