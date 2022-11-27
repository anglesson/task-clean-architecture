<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskServiceImpl;
use App\ToDo\Domain\UseCases\FindTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class DeleteTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository = new DoctrineRepository();
        $findTaskService = new FindTaskServiceImpl($repository);
        $deleteTaskRepository = new DeleteTaskServiceImpl($repository, $findTaskService);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
