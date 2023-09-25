<?php

namespace App\ToDo\Domain\Entity;

class SuperTask
{
    private string $attr;

    public function getAttr(): string
    {
        return $this->attr;
    }

    public function setAttr(string $attr): self
    {
        return $this->attr;
    }
}
