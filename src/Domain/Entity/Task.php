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
        if (!$description) {
            throw new InvalidParamError('description');
        }

        if (strlen($description) > 50) {
            throw new DescriptionHasMoreThan50Caracters();
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
}
