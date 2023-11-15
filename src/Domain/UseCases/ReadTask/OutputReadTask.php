<?php

namespace App\ToDo\Domain\UseCases\ReadTask;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\Task;

class OutputReadTask extends DataTransferObject
{
    public ?string $id;
    public ?string $description;
    public ?bool $finished;

    public static function create(Task $task): OutputReadTask
    {
        return new self($task->toArray());
    }
}
