<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;

interface IFindTaskUseCase
{
    public function execute($idTask): Task;
}
