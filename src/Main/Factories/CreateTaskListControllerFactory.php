<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskListController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCaseImpl;

final class CreateTaskListControllerFactory
{
    public static function create(TaskListRepository $repository): Controller
    {
        $createTaskListService = new CreateTaskListUseCaseImpl($repository);
        return new CreateTaskListController($createTaskListService, );
    }
}
