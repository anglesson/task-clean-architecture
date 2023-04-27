<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ListAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\ListAllTasks\IListAllTasksUseCaseImpl;
use App\ToDo\Domain\Protocols\ITaskRepository;

final class ListAllTasksControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $listAllTaskService = new IListAllTasksUseCaseImpl($repository);
        return new ListAllTaskController($listAllTaskService);
    }
}
