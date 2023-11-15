<?php

namespace App\ToDo\Application\Presenters\ListTask;

use App\ToDo\Application\Resources\JsonResource;

interface ListTaskPresenter
{
    public function toJson(array $outputReadTask): JsonResource;
}
