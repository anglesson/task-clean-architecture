<?php

namespace App\ToDo\Infrastructure\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Domain\Services\DeleteTaskServiceImpl;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
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
