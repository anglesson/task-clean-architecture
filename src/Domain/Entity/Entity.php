<?php

namespace App\ToDo\Domain\Entity;

abstract class Entity
{
    protected ?string $id = null;

    public function getId(): ?string
    {
        return $this->id;
    }
}
