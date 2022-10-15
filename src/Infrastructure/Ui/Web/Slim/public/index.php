<?php

require __DIR__ . '../../../../../../../vendor/autoload.php';

use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use Slim\Factory\AppFactory;
use App\ToDo\Main\Adapters\SlimRouteAdapter;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->post('/api/task', new SlimRouteAdapter(CreateTaskControllerFactory::create()));
$app->get('/api/task/{id}', new SlimRouteAdapter(ReadTaskControllerFactory::create()));
$app->put('/api/task/{id}', new SlimRouteAdapter(UpdateTaskControllerFactory::create()));
$app->delete('/api/task/{id}', new SlimRouteAdapter(DeleteTaskControllerFactory::create()));

$app->run();
