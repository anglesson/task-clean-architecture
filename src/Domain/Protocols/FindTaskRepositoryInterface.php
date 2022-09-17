<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface FindTaskRepositoryInterface
{
    public function findOne(string $idTask): ?Task;
}
