<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface CreateTaskRepository
{
    public function save(Task $task): Task;
}
