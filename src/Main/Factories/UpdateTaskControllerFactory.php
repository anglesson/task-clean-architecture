<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCaseImpl;

final class UpdateTaskControllerFactory
{
    public static function create(TaskRepository $repository): Controller
    {
        $updateTaskService = new UpdateTaskUseCaseImpl($repository);
        return new UpdateTaskController($updateTaskService);
    }
}
