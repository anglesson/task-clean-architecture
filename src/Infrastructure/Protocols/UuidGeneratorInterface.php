<?php

namespace Anglesson\Exemplo\Infrastructure\Protocols;

interface UuidGeneratorInterface
{
    public function generateId(): string;
}
