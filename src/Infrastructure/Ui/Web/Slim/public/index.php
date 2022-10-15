<?php

require __DIR__ . '../../../../../../../vendor/autoload.php';

use App\ToDo\Infrastructure\Factories\ReadTaskControllerFactory;
use App\ToDo\Infrastructure\Factories\UpdateTaskControllerFactory;
use Slim\Factory\AppFactory;
use App\ToDo\Infrastructure\Adapters\SlimRouteAdapter;
use App\ToDo\Infrastructure\Factories\CreateTaskControllerFactory;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->post('/api/task', new SlimRouteAdapter(CreateTaskControllerFactory::create()));
$app->get('/api/task/{id}', new SlimRouteAdapter(ReadTaskControllerFactory::create()));
$app->put('/api/task/{id}', new SlimRouteAdapter(UpdateTaskControllerFactory::create()));

$app->run();
