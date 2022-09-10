<?php

namespace Anglesson\Exemplo\Domain\Protocols;

use Anglesson\Exemplo\Domain\Entity\Task;

interface TaskRepositoryInterface
{
    // /** @return Task[] */
    // public function list(): array;
    // public function findById(string $id): ?Task;
    public function save(Task $task): Task;
    // public function update(Task $tarefa): Task;
    // public function delete(Task $tarefa): void;
}