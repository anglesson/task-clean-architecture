<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\Validators\RequiredFieldValidation;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $validations = [];
        foreach (['description'] as $requiredField) {
            array_push($validations, new RequiredFieldValidation($requiredField));
        }
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new DoctrineRepository();
        $validation = new ValidationComposite($validations);
        $createTaskService = new CreateTaskUseCase($repository, $ramseyUuid, $validation);
        return new CreateTaskController($createTaskService);
    }
}
