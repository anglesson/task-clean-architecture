<?php

namespace Anglesson\Task\Domain\Entity;

class Task
{
    public ?string $id;
    public string $description;
    public bool $finished;

    public function __construct()
    {
        $this->finished = false;
    }
}
