<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\FindTask\IFindTaskUseCaseImpl;
use App\ToDo\Domain\Protocols\ITaskRepository;

final class ReadTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $readTaskService = new IFindTaskUseCaseImpl($repository);
        return new ReadTaskController($readTaskService);
    }
}
