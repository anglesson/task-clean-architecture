<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface ITaskRepository
{
    public function delete(string $idTask): void;
    public function findOne(string $idTask): ?Task;
}
