<?php

namespace App\ToDo\Domain\Protocols;

interface ListAllTasksService
{
    public function list(): array;
}
