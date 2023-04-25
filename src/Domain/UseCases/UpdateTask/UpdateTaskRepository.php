<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\Entity\Task;

interface UpdateTaskRepository
{
    public function update(Task $task): ?Task;
}
