<?php

namespace App\ToDo\Infrastructure\Utils;

use App\ToDo\Domain\Protocols\UuidGenerator;
use Symfony\Component\Uid\Uuid;

class SymfonyUidImpl implements UuidGenerator
{
    public function generateId(): string
    {
        return Uuid::v4();
    }
}
