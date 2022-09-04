<?php

// require 'vendor/autoload.php';

// use Anglesson\Exemplo\Domain\Entity\Task;
// use Anglesson\Exemplo\Domain\Services\CreateTaskService;
// use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;
// use Anglesson\Exemplo\Infrastructure\Utils\RamseyUuid;

// $uuidGenerator = new RamseyUuid();
// $mockRepository = new MockRepository($uuidGenerator);
// $taskCreateService = new CreateTaskService($mockRepository);
// $task = new Task();
// $task->description = 'Minha tarefa Criada';
// $task->finished = false;
// $taskCriada = $taskCreateService->create($task);
// echo '<pre>';
// var_dump($taskCriada);
// echo '</pre>';
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Anglesson\Exemplo\Application\Api\TaskCreateController;
use Anglesson\Exemplo\Domain\Services\CreateTaskService;
use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;
use Anglesson\Exemplo\Infrastructure\Utils\RamseyUuid;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$uuidGenerator = new RamseyUuid();
$mockRepository = new MockRepository($uuidGenerator);
$createTaskService = new CreateTaskService($mockRepository);
$obj = new TaskCreateController($createTaskService);
$app->get('/api/task', $obj);

$app->run();