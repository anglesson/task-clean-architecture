<?php

require __DIR__ . '../../../../../../../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Anglesson\Task\Infrastructure\Adapters\SlimRouteAdapter;
use Anglesson\Task\Infrastructure\Factories\CreateTaskControllerFactory;

$app = AppFactory::create();

$app->any('/api/task', new SlimRouteAdapter(CreateTaskControllerFactory::create()));

$app->run();
