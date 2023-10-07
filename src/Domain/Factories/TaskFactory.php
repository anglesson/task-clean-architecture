<?php 

namespace App\ToDo\Domain\Factories;

use App\ToDo\Domain\Entity\Task;

final class TaskFactory
{
    public static function create (string $description) {
        $task = new Task($description);
    }
}
