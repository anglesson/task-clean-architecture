<?php

namespace App\ToDo\Domain\UseCases\ListAllTasks;

interface IListAllTasksUseCase
{
    public function execute(): array;
}
