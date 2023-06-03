<?php

namespace App\ToDo\Application\UseCases\UpdateTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\Task;

class OutputUpdateTask extends DataTransferObject
{
    public ?string $id;
    public ?string $description;
    public ?bool $finished;

    public static function create(Task $task)
    {
        return new self($task->toArray());
    }
}