<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\ListTasksController;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenterImpl;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCaseImpl;
use App\ToDo\Main\CompositionRoot;

final class ListAllTasksControllerFactory
{
    public static function create(): Controller
    {
        $repository         = CompositionRoot::createTaskRepository();
        $listAllTaskService = new ListTasksUseCaseImpl($repository);
        $presenter          = new ListTaskPresenterImpl();
        return new ListTasksController($listAllTaskService, $presenter);
    }
}
