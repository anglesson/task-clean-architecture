<?php

namespace App\ToDo\Domain\UseCases\ListAllTasks;

use App\ToDo\Domain\Entity\Task;

interface ListAllTasksRepository
{
    /** @return Task[] */
    public function list(): array;
}
