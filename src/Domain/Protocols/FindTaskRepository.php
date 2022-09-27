<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface FindTaskRepository
{
    public function findOne(string $idTask): ?Task;
}
