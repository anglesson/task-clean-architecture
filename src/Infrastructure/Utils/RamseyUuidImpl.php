<?php

namespace App\ToDo\Infrastructure\Utils;

use Ramsey\Uuid\Uuid;
use App\ToDo\Infrastructure\Protocols\UuidGenerator;

class RamseyUuidImpl implements UuidGenerator
{
    public function generateId(): string
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }
}
