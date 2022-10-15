<?php

namespace App\ToDo\Domain\Protocols;

interface ListAllTasksRepository
{
    public function list(): array;
}
