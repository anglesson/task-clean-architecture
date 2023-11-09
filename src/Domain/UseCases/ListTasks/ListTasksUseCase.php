<?php

namespace App\ToDo\Domain\UseCases\ListTasks;

interface ListTasksUseCase
{
    public function execute(): array;
}
