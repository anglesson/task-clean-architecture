<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Application\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Application\UseCases\UpdateTask\OutputUpdateTask;

interface IUpdateTaskUseCase
{
    public function update(InputUpdateTask $inputUpdateTask): OutputUpdateTask;
}
