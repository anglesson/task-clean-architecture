<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;

interface IFindTaskUseCase
{
    public function execute($idTask): OutputCreateTask;
}
