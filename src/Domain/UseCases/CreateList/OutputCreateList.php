<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Domain\Entity\TaskList;

class OutputCreateList extends DataTransferObject
{
    public ?string $name;
    public ?array $tasks;

    public static function create(TaskList $taskList): OutputCreateList
    {
        return new self($taskList->toArray());
    }
}