<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;

interface FindTaskService
{
    public function find($idTask): Task;
}
