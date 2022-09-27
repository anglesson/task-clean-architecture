<?php

namespace Anglesson\Task\Domain\Protocols;

use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Application\DTO\TaskDTO;

interface CreateTaskService
{
    public function create(TaskDTO $taskDTO): Task;
}
