<?php

use Anglesson\Exemplo\Domain\UseCases\ConcluirTarefa;
use Anglesson\Exemplo\Infra\TarefaRepositoryMongoDB;
use Anglesson\Exemplo\Domain\Task;

require 'vendor/autoload.php';

$concluirTarefa = new ConcluirTarefa(new TarefaRepositoryMongoDB());
$tarefa = new Task();
$tarefa->titulo = 'Teste';

$concluirTarefa->handle($tarefa);
