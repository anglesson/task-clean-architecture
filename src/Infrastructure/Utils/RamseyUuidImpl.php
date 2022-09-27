<?php

namespace Anglesson\Task\Infrastructure\Utils;

use Anglesson\Task\Infrastructure\Protocols\UuidGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidImpl implements UuidGenerator
{
    public function generateId(): string
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }
}
