<?php

namespace App\ToDo\Infrastructure\Protocols;

interface UuidGenerator
{
    public function generateId(): string;
}
