<?php

require __DIR__ . '../../../../../../../vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\ToDo\Infrastructure\Adapters\SlimRouteAdapter;
use App\ToDo\Infrastructure\Factories\CreateTaskControllerFactory;

$app = AppFactory::create();

$app->any('/api/task', new SlimRouteAdapter(CreateTaskControllerFactory::create()));

$app->run();
