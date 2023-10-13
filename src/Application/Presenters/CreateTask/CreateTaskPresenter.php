<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;

class CreateTaskPresenter implements ICreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): string
    {
        return json_encode([
            'id' => $outputCreateTask->id,
            'description' => strtolower($outputCreateTask->description),
        ]);
    }
}
