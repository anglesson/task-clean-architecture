<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Characters;
use App\ToDo\Domain\Exceptions\InvalidParamError;
use DateTime;

class Task extends Entity
{
    private string $description;
    private bool $finished;
    private DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(string $description, string $id = null)
    {
        $this->id = $id;
        $this->setDescription($description);
        $this->finished = false;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        if (strlen($description) > 50) {
            throw new DescriptionHasMoreThan50Characters();
        }

        $this->description = $description;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return \get_object_vars($this);
    }

    public function setFinished(bool $finished): void
    {
        $this->finished = $finished;
    }

    public function lastUpdate(): DateTime
    {
        return $this->updatedAt;
    }
}
