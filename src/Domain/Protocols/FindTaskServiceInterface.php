<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface FindTaskServiceInterface
{
    public function find($idTask): Task;
}
