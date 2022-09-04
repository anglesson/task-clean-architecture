<?php

namespace Anglesson\Exemplo\Domain\Protocols;

use Anglesson\Exemplo\Domain\Entity\Task;

interface CreateTaskServiceInterface
{
    public function create(Task $task): Task;
}