<?php

namespace App\ToDo\Domain\UseCases\FindTask;

use App\ToDo\Domain\Entity\Task;

interface FindTaskRepository
{
    public function findOne(string $idTask): ?Task;
}
