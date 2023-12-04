<?php

use App\ToDo\Infrastructure\Utils\Environment;
use App\ToDo\Main\Application;

require __DIR__ . '/../vendor/autoload.php';

Environment::load(__DIR__.'/../');

$app = new Application();
$app->start();
