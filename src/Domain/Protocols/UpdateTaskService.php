<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface UpdateTaskService
{
    public function update(string $idTask, array $params): Task;
}
