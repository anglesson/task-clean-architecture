<?php

require 'vendor/autoload.php';

use Anglesson\Exemplo\Domain\Entity\Task;
use Anglesson\Exemplo\Domain\Services\CreateTaskService;
use Anglesson\Exemplo\Infrastructure\Repositories\MockRepository;

$mockRepository = new MockRepository();
$taskCreateService = new CreateTaskService($mockRepository);
$task = new Task();
$task->description = 'Minha tarefa Criada';
$task->finished = false;
$taskCriada = $taskCreateService->create($task);
echo 'Task criada: '. $taskCriada->description;