<?php

namespace App\ToDo\Infrastructure\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new DoctrineRepository($ramseyUuid);
        $createTaskService = new CreateTaskServiceImpl($repository);
        return new CreateTaskController($createTaskService);
    }
}
