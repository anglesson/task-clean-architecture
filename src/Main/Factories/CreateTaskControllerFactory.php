<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Application\UseCases\CreateTask\Validators\CreateTaskValidationFactory;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

final class CreateTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $validation = CreateTaskValidationFactory::makeValidations();
        $createTaskService = new CreateTaskUseCaseImpl($repository, $ramseyUuid, $validation);
        return new CreateTaskController($createTaskService);
    }
}
