<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface DeleteTaskRepositoryInterface
{
    public function delete(Task $task): void;
}
