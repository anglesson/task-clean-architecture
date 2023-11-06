<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\Utils\Fillable;

abstract class Entity
{
    protected ?string $id = null;

    public function getId(): ?string
    {
        return $this->id;
    }
}
