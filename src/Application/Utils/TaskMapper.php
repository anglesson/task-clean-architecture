<?php

namespace Anglesson\Task\Application\Utils;

use Anglesson\Task\Domain\Entity\Task;

class TaskMapper
{
    public static function toDomain(array $array)
    {
        $task = new Task();
        if (!$array) {
            foreach ($array as $key => $value) {
                $task->description = $array['description'];
                $task->finished = $array['finished'];
            }
        }
        return $task;
    }
}
