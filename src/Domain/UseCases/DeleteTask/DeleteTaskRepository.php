<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

use App\ToDo\Domain\Entity\Task;

interface DeleteTaskRepository
{
    public function delete(Task $task): void;
}
