<?php

namespace Anglesson\Exemplo\Domain\Entity;

class Task
{
    public ?string $id;
    public string $description;
    public bool $finished;
}