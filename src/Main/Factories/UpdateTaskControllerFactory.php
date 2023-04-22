<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\FindTaskServiceImpl;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskServiceImpl;

final class UpdateTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $findTaskService = new FindTaskServiceImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);
        return new UpdateTaskController($updateTaskService);
    }
}
