<?php

namespace Anglesson\Exemplo\Infrastructure\Utils;

use Anglesson\Exemplo\Infrastructure\Protocols\UuidGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuid implements UuidGeneratorInterface {
  public function generateId(): string {
    $uuid = Uuid::uuid4();
    return $uuid->toString();
  }
}