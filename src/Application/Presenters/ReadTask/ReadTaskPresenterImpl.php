<?php

namespace App\ToDo\Application\Presenters\ReadTask;

use App\ToDo\Application\Resources\JsonResource;
use App\ToDo\Domain\UseCases\ReadTask\OutputReadTask;

class ReadTaskPresenterImpl implements ReadTaskPresenter
{
    public function toJson(OutputReadTask $outputReadTask): JsonResource
    {
        return new JsonResource($outputReadTask->toArray());
    }
}
