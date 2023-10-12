<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Caracters;
use App\ToDo\Domain\Exceptions\InvalidParamError;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\Utils\Fillable;
use DateTime;

class Task extends Entity
{
    use Fillable;

    private string $description;
    private bool $finished;
    private DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(string $id, string $description)
    {
        parent::__construct($id);
        $this->description = $description;
        $this->finished = false;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;

        $this->validate();
    }

    private function validate(): void
    {
        if (!$this->description) {
            throw new InvalidParamError('description');
        }

        if (strlen($this->description) > 50) {
            throw new DescriptionHasMoreThan50Caracters();
        }
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Task
    {
        $this->description = $description;
        $this->validate();
        $this->registerUpdate();
        return $this;
    }

    public function getFinished(): bool
    {
        return $this->finished;
    }

    public function done(): Task
    {
        $this->finished = true;
        return $this;
    }

    public function undone(): Task
    {
        $this->finished = false;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    private function registerUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function toArray(): array
    {
        return \array_merge(\get_object_vars($this), parent::toArray());
    }
}
