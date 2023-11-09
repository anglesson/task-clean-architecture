<?php

namespace App\ToDo\Domain\UseCases\ReadTask;

use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;

interface ReadTaskUseCase
{
    public function execute($idTask): OutputCreateTask;
}
