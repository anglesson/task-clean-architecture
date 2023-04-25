<?php

namespace App\ToDo\Application\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;

class InputCreateTask extends DataTransferObject
{
    public ?string $description;

    public static function create(array $array): InputCreateTask
    {
        return new self($array);
    }
}
