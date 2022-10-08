<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface FindTaskRepository
{
    public function findOne(string $idTask): ?Task;
}
