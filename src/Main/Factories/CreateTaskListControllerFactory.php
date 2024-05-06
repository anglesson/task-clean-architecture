<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskListController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCaseImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

final class CreateTaskListControllerFactory
{
    public static function create(TaskListRepository $repository): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $createTaskListService = new CreateTaskListUseCaseImpl($repository, $ramseyUuid);
        return new CreateTaskListController($createTaskListService, );
    }
}
