<?php

namespace Anglesson\Exemplo\Domain;

interface TaskRepositoryInterface
{
    /** @return Task[] */
    public function list(): array;
    public function findById(string $id): ?Task;
    public function save(Task $tarefa): Task;
    public function update(Task $tarefa): Task;
    public function delete(Task $tarefa): void;
}