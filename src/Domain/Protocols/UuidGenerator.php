<?php

namespace App\ToDo\Domain\Protocols;

interface UuidGenerator
{
    public function generateId(): string;
}
