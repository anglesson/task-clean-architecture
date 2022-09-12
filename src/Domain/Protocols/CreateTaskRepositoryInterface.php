<?php

namespace Anglesson\Exemplo\Domain\Protocols;

use Anglesson\Exemplo\Domain\Entity\Task;

interface CreateTaskRepositoryInterface
{
    public function save(Task $task): Task;
}
