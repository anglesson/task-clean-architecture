<?php

namespace App\ToDo\Infrastructure\Utils;

use App\ToDo\Domain\Protocols\UuidGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidImpl implements UuidGenerator
{
    public function generateId(): string
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }
}
