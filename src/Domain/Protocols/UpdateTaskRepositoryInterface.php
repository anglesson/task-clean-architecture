<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface UpdateTaskRepositoryInterface
{
    public function update(Task $task): ?Task;
}
