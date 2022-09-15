<?php

namespace Anglesson\Task\Infrastructure\Protocols;

interface UuidGeneratorInterface
{
    public function generateId(): string;
}
