<?php

namespace App\ToDo\Domain\Services\CreateTask;

use App\ToDo\Application\DTO\DataTransferObject;

class InputCreateTask extends DataTransferObject
{
    public ?string $description;
}
