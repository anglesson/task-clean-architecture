<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;

class InputCreateTask extends DataTransferObject
{
    public ?string $description;

    public static function create(array $array)
    {
        return new self($array);
    }
}
