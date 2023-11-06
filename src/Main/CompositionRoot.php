<?php

namespace App\ToDo\Main;

use App\ToDo\Application\Protocols\Http\HttpServer;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;

class CompositionRoot
{
    public static function createTaskRepository(): ITaskRepository
    {
        return new TaskDoctrineRepository();
    }

    public static function createServer(): HttpServer
    {
        return new SlimHttpServerAdapter();
    }
}
