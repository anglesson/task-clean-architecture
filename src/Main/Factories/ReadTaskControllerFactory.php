<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\FindTask\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;

final class ReadTaskControllerFactory
{
    public static function create(ITaskRepository $repository): Controller
    {
        $readTaskService = new FindTaskServiceImpl($repository);
        return new ReadTaskController($readTaskService);
    }
}
