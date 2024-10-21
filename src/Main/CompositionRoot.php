<?php

namespace App\ToDo\Main;

use App\ToDo\Infrastructure\ErrorHandling\ErrorHandler;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Http\Slim\SlimHttpServer;
use App\ToDo\Infrastructure\Utils\Environment;
use App\ToDo\Infrastructure\Utils\LoadEnvInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

class CompositionRoot
{
    public static function createServer(): HttpServer
    {
        $container = self::createContainer();
        AppFactory::setContainer($container);
        return new SlimHttpServer(AppFactory::createFromContainer($container));
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

    public static function createContainer(): ContainerInterface
    {
        $definitions = require __DIR__ .'/../Infrastructure/DI/definitions.php';

        $builder = new ContainerBuilder();
        $builder->addDefinitions($definitions);
        return $builder->build();
    }
}
