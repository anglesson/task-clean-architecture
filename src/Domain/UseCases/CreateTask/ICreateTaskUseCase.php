<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;

interface ICreateTaskUseCase
{
    public function execute(InputCreateTask $inputCreateTask): OutputCreateTask;
}
