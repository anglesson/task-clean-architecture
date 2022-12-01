<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\Validators\CreateTaskValidationFactory;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new DoctrineRepository();
        $validation = CreateTaskValidationFactory::makeValidations();
        $createTaskService = new CreateTaskUseCase($repository, $ramseyUuid, $validation);
        return new CreateTaskController($createTaskService);
    }
}
