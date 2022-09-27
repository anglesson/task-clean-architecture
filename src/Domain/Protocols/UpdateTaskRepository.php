<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface UpdateTaskRepository
{
    public function update(Task $task): ?Task;
}
