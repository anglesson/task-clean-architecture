<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\DeleteTaskController;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCaseImpl;
use App\ToDo\Main\CompositionRoot;

final class DeleteTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository           = CompositionRoot::createTaskRepository();
        $deleteTaskRepository = new DeleteTaskUseCaseImpl($repository);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
