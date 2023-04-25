<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;

interface FindTaskService
{
    public function find($idTask): Task;
}
