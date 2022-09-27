<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface DeleteTaskRepository
{
    public function delete(Task $task): void;
}
