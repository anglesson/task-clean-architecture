<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface UpdateTaskServiceInterface
{
    public function update(string $idTask, array $params): Task;
}
