<?php

namespace App\ToDo\Application\Presenters\CreateTask;

use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;

interface ICreateTaskPresenter
{
    public function toJson(OutputCreateTask $outputCreateTask): string;
}
