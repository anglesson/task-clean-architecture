<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\TaskList;

interface TaskListRepository
{
    public function save(TaskList $taskList): TaskList;
}