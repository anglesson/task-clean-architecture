<?php

namespace Anglesson\Task\Infrastructure\Utils;

use Anglesson\Task\Infrastructure\Protocols\UuidGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuid implements UuidGeneratorInterface
{
    public function generateId(): string
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }
}
