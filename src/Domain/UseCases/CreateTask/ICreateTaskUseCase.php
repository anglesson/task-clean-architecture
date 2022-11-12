<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;

interface ICreateTaskUseCase
{
    public function create(InputCreateTask $inputCreateTask): OutputCreateTask;
}
