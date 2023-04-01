<?php

use App\ToDo\Infrastructure\Api\Router;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;

require __DIR__ . '/../../vendor/autoload.php';

$httpServer = new SlimHttpServerAdapter();
$router = new Router($httpServer);
$router->init();
$httpServer->listen();
