<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface CreateTaskRepository
{
    public function save(Task $task): Task;
}
