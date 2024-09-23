<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\DeleteTaskController;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCaseImpl;

final class DeleteTaskControllerFactory
{
    public static function create(TaskRepository $repository): Controller
    {
        $deleteTaskRepository = new DeleteTaskUseCaseImpl($repository);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
