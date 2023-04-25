<?php

namespace App\ToDo\Application\UseCases\UpdateTask;

use App\ToDo\Application\DTO\DataTransferObject;

class InputUpdateTask extends DataTransferObject
{
    public ?string  $id;
    public ?string  $description;
    public ?bool    $finished;

    public static function create(array $array)
    {
        return new self($array);
    }
}
