<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\FindTask\FindTaskUseCaseImpl;
use App\ToDo\Application\UseCases\UpdateTask\UpdateTaskServiceImpl;
use App\ToDo\Domain\Protocols\ITaskRepository;

final class UpdateTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $updateTaskService = new UpdateTaskServiceImpl($repository);
        return new UpdateTaskController($updateTaskService);
    }
}
