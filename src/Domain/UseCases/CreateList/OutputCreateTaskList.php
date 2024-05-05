<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\TaskList;

class OutputCreateTaskList extends DataTransferObject
{
    public ?string $name;
    public ?array $tasks;

    public static function create(TaskList $taskList): OutputCreateTaskList
    {
        return new self($taskList->toArray());
    }
}