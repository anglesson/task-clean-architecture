<?php

namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\UseCases\CreateList\OutputCreateTaskList;

interface CreateTaskListUseCase
{
    public function execute(string $name): OutputCreateTaskList;
}
