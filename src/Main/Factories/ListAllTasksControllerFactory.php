<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ListAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\ListAllTasks\ListAllTasksServiceImpl;

final class ListAllTasksControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $listAllTaskService = new ListAllTasksServiceImpl($repository);
        return new ListAllTaskController($listAllTaskService);
    }
}
