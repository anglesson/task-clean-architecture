<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCaseImpl;

final class DeleteTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $deleteTaskRepository = new DeleteTaskUseCaseImpl($repository);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
