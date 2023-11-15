<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Domain\UseCases\CreateTask\Validators\CreateTaskValidationFactory;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

final class CreateTaskControllerFactory
{
    public static function create(TaskRepository $repository): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $validation = CreateTaskValidationFactory::makeValidations();
        $presenter = new CreateTaskPresenterImpl();
        $createTaskService = new CreateTaskUseCaseImpl($repository, $ramseyUuid, $validation);
        return new CreateTaskController($createTaskService, $presenter);
    }
}
