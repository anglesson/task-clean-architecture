<?php

namespace Anglesson\Task\Infrastructure\Protocols;

interface UuidGenerator
{
    public function generateId(): string;
}
