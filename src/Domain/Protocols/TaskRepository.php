<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface TaskRepository
{
    public function save(Task $task): Task;
    public function findOne(string $idTask): ?Task;
    public function update(Task $task): Task;
    public function delete(string $idTask): void;
    /** @return Task[] */
    public function list(): array;
}
