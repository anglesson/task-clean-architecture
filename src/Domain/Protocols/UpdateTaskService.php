<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface UpdateTaskService
{
    public function update(string $idTask, array $params): Task;
}
