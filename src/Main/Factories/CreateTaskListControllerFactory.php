<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\CreateTaskListController;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCaseImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Main\CompositionRoot;

final class CreateTaskListControllerFactory
{
    public static function create(): Controller
    {
        $repository            = CompositionRoot::createTaskListRepository();
        $ramseyUuid            = new RamseyUuidImpl();
        $createTaskListService = new CreateTaskListUseCaseImpl($repository, $ramseyUuid);
        return new CreateTaskListController($createTaskListService, );
    }
}
