<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface CreateTaskRepositoryInterface
{
    public function save(Task $task): Task;
}
