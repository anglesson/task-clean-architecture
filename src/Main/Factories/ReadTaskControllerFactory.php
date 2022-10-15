<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class ReadTaskControllerFactory
{
    public static function create(): Controller
    {
        $repository = new DoctrineRepository();
        $readTaskService = new FindTaskServiceImpl($repository);
        return new ReadTaskController($readTaskService);
    }
}
