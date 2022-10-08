<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Application\DTO\TaskDTO;

interface CreateTaskService
{
    public function create(TaskDTO $taskDTO): Task;
}
