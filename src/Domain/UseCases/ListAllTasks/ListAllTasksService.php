<?php

namespace App\ToDo\Domain\UseCases\ListAllTasks;

interface ListAllTasksService
{
    public function list(): array;
}
