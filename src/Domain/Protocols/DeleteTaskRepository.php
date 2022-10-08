<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface DeleteTaskRepository
{
    public function delete(Task $task): void;
}
