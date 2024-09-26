<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\UpdateTaskController;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenterImpl;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCaseImpl;
use App\ToDo\Main\CompositionRoot;

final class UpdateTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository        = CompositionRoot::createTaskRepository();
        $updateTaskService = new UpdateTaskUseCaseImpl($repository);
        $presenter         = new UpdateTaskPresenterImpl();
        return new UpdateTaskController($updateTaskService, $presenter);
    }
}
