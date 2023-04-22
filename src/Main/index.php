<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\ToDo\Infrastructure\Api\Router;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;
use App\ToDo\Main\CompositionRoot;

$httpServer = new SlimHttpServerAdapter();
$repository = CompositionRoot::createTaskRepository();
$router = new Router($httpServer, $repository);
$router->init();
$httpServer->listen();
