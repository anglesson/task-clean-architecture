<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\Utils\Fillable;

abstract class Entity
{
    use Fillable;

    private ?string $id = null;

    public function __construct(string $id = null)
    {
        if (!$this->id) {
            $this->id = $id;
        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id = null): void
    {
        $this->id = $id;
    }
}
