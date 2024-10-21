<?php

namespace App\ToDo\Application\Presenters\ReadTask;

use App\ToDo\Infrastructure\Web\Resources\JsonResource;
use App\ToDo\Domain\UseCases\ReadTask\OutputReadTask;

interface ReadTaskPresenter
{
    public function toJson(OutputReadTask $outputReadTask): JsonResource;
}
