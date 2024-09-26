<?php

namespace App\ToDo\Main;

use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Infrastructure\ErrorHandling\ErrorHandler;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Http\Slim\SlimHttpServer;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskListDoctrineRepository;
use App\ToDo\Infrastructure\Utils\Environment;
use App\ToDo\Infrastructure\Utils\LoadEnvInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
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
        return new SlimHttpServer($app);
    }

    public static function createLoadEnv(): LoadEnvInterface
    {
        return new Environment();
    }

    public static function createLogger(): Logger
    {
        $today  = date('Y-m-d');
        $stream = new StreamHandler(__DIR__ . "/../../logs/$today.log", Level::Debug, 755);
        $logger = new Logger('app');
        $logger->pushHandler($stream);
        return $logger;
    }

    public static function createErrorHandler(): ErrorHandler
    {
        return new ErrorHandler(self::createLogger());
    }
}
