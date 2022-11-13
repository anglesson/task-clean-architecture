<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;

interface UpdateTaskService
{
    public function update(InputUpdateTask $inputUpdateTask): OutputUpdateTask;
}
