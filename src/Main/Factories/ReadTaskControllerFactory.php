<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Controllers\ReadTaskController;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenterImpl;
use App\ToDo\Application\Controllers\Controller;
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
