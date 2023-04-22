<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface ListAllTasksRepository
{
    /** @return Task[] */
    public function list(): array;
}
