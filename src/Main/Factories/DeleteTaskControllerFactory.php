<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\DeleteTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\DeleteTask\IDeleteTaskUseCaseImpl;
use App\ToDo\Domain\Protocols\ITaskRepository;

final class DeleteTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $deleteTaskRepository = new IDeleteTaskUseCaseImpl($repository);
        return new DeleteTaskController($deleteTaskRepository);
    }
}
