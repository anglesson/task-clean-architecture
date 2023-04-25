<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Entity\Task;

interface CreateTaskRepository
{
    public function save(Task $task): Task;
}
