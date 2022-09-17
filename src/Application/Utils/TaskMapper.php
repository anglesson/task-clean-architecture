<?php

namespace Anglesson\Task\Application\Utils;

use Anglesson\Task\Domain\Entity\Task;

class TaskMapper
{
    public static function toDomain(array $array)
    {
        $task = new Task();
        $task->description = $array['description'] ?? '';
        return $task;
    }
}
