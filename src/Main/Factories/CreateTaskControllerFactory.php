<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Infrastructure\Web\Controllers\Controller;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Main\Factories\CreateTaskValidationFactory;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Main\CompositionRoot;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository        = CompositionRoot::createTaskRepository();
        $ramseyUuid        = new RamseyUuidImpl();
        $validation        = CreateTaskValidationFactory::makeValidations();
        $presenter         = new CreateTaskPresenterImpl();
        $createTaskService = new CreateTaskUseCaseImpl($repository, $ramseyUuid, $validation);
        return new CreateTaskController($createTaskService, $presenter);
    }
}
