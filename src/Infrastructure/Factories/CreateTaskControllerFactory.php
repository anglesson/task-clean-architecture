<?php

namespace App\ToDo\Infrastructure\Factories;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new MockRepository($ramseyUuid);
        $createTaskService = new CreateTaskServiceImpl($repository);
        return new CreateTaskController($createTaskService);
    }
}
