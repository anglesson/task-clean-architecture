<?php

namespace App\ToDo\Infrastructure\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Domain\Services\UpdateTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class UpdateTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository = new DoctrineRepository();
        $findTaskService = new FindTaskServiceImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);
        return new UpdateTaskController($updateTaskService);
    }
}
