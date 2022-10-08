<?php

namespace App\ToDo\Application\Utils;

use App\ToDo\Domain\Entity\Task;

class TaskMapper
{
    public static function toDomain(array $array)
    {
        $task = new Task();
        $task->fill($array);
        return $task;
    }
}
