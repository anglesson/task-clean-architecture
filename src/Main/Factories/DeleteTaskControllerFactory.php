<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;

final class DeleteTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $deleteTaskRepository = new DeleteTaskServiceImpl($repository);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
