<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new DoctrineRepository();
        $createTaskService = new CreateTaskServiceImpl($repository, $ramseyUuid);
        return new CreateTaskController($createTaskService);
    }
}
