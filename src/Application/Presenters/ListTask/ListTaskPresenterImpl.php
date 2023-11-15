<?php

namespace App\ToDo\Application\Presenters\ListTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\ListTasks\OutputListTask;

class ListTaskPresenterImpl implements ListTaskPresenter
{
    public function toJson(array $outputListTask): JsonResource
    {
        return new JsonResource($outputListTask);
    }
}
