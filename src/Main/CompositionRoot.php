<?php

namespace App\ToDo\Main;

use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Http\Slim\SlimHttpServer;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskListDoctrineRepository;
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
        return new SlimHttpServer($app, self::createTaskRepository());
    }
}
