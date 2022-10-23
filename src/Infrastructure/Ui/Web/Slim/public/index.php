<?php

require __DIR__ . '../../../../../../../vendor/autoload.php';

use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use Slim\Factory\AppFactory;
use App\ToDo\Main\Adapters\SlimControllerAdapter;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->post('/api/task', new SlimControllerAdapter(CreateTaskControllerFactory::create()));
$app->get('/api/task/{id}', new SlimControllerAdapter(ReadTaskControllerFactory::create()));
$app->get('/api/task', new SlimControllerAdapter(ListAllTasksControllerFactory::create()));
$app->put('/api/task/{id}', new SlimControllerAdapter(UpdateTaskControllerFactory::create()));
$app->delete('/api/task/{id}', new SlimControllerAdapter(DeleteTaskControllerFactory::create()));

$app->run();
