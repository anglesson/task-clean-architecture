<?php

use App\ToDo\Infrastructure\Api\Router;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;

require __DIR__ . '/../../vendor/autoload.php';


$httpServer = new SlimHttpServerAdapter();
$app = new Router($httpServer);
$app->init();
$httpServer->listen();