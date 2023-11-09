<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\Task;

class OutputCreateTask extends DataTransferObject
{
    public ?string $id;
    public ?string $description;
    public ?bool $finished;

    public static function create(Task $task): OutputCreateTask
    {
        return new self($task->toArray());
    }
}
