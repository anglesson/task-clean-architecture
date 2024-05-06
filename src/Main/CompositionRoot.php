<?php

namespace App\ToDo\Main;

use App\ToDo\Application\Protocols\Http\HttpServer;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskListDoctrineRepository;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;
use Slim\Factory\AppFactory;

class CompositionRoot
{
    public static function createTaskRepository(): TaskRepository
    {
        return new TaskDoctrineRepository();
    }

    public static function createTaskListRepository(): TaskListRepository
    {
        return new TaskListDoctrineRepository();
    }

    public static function createServer(): HttpServer
    {
        $app = AppFactory::create();
        return new SlimHttpServerAdapter($app);
    }
}
