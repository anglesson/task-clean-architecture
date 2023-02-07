<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\FindTask\FindTaskServiceImpl;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskServiceImpl;
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
