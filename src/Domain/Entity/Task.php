<?php

namespace App\ToDo\Domain\Entity;

use DateTime;

class Task extends Entity
{
    private string $description;
    private bool $finished;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(string $description, string $id = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->finished = false;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function updateDescription(string $description): void
    {
        $this->description = $description;
        $this->updateDateTime();
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function done(): void
    {
        $this->finished = true;
        $this->updateDateTime();
    }

    public function undo(): void
    {
        $this->finished = false;
        $this->updateDateTime();
    }

    public function lastUpdate(): ?DateTime
    {
        return $this->updatedAt;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    private function updateDateTime(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function toArray(): array
    {
        return \get_object_vars($this);
    }
}
