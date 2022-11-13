<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;

interface IUpdateTaskUseCase
{
    public function update(InputUpdateTask $inputUpdateTask): OutputUpdateTask;
}
