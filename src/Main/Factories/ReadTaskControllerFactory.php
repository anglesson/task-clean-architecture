<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenterImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCaseImpl;

final class ReadTaskControllerFactory
{
    public static function create(TaskRepository $repository): Controller
    {
        $readTaskService = new ReadTaskUseCaseImpl($repository);
        $presenter = new ReadTaskPresenterImpl();
        return new ReadTaskController($readTaskService, $presenter);
    }
}
