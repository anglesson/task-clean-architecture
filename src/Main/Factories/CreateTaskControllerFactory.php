<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new DoctrineRepository();
        $createTaskService = new CreateTaskUseCase($repository, $ramseyUuid);
        return new CreateTaskController($createTaskService);
    }
}
