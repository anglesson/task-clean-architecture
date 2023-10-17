<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Caracters;
use App\ToDo\Domain\Exceptions\InvalidParamError;
use App\ToDo\Domain\Utils\Fillable;
use DateTime;

class Task extends Entity
{
    use Fillable;

    private string $description;
    private bool $finished;
    private DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(string $description)
    {
        $this->setDescription($description);
        $this->finished = false;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Task
    {
        if (!$description) {
            throw new InvalidParamError('description');
        }

        if (strlen($description) > 50) {
            throw new DescriptionHasMoreThan50Caracters();
        }

        $this->description = $description;
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

    public function toArray(): array
    {
        return \get_object_vars($this);
    }
}
