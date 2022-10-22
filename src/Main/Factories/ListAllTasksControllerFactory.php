<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Api\ListAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Services\ListAllTasksServiceImpl;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;

final class ListAllTasksControllerFactory
{
    public static function create(): Controller
    {
        $repository = new DoctrineRepository();
        $listAllTaskService = new ListAllTasksServiceImpl($repository);
        return new ListAllTaskController($listAllTaskService);
    }
}
