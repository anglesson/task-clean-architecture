<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ListTasksController;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenterImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCaseImpl;

final class ListAllTasksControllerFactory
{
    public static function create(TaskRepository $repository): Controller
    {
        $listAllTaskService = new ListTasksUseCaseImpl($repository);
        $presenter = new ListTaskPresenterImpl();
        return new ListTasksController($listAllTaskService, $presenter);
    }
}
