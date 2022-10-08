<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface UpdateTaskRepository
{
    public function update(Task $task): ?Task;
}
