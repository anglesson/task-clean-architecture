<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface CreateTaskServiceInterface
{
    public function create(array $data): Task;
}
