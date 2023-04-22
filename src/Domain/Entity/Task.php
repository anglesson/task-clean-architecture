<?php

namespace App\ToDo\Domain\Entity;

use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Caracters;
use App\ToDo\Domain\Exceptions\InvalidParamError;
use App\ToDo\Domain\Utils\Fillable;

class Task
{
    use Fillable;

    // TODO: Remove this attribute, it should stay on repository
    private array $fillable = [
        'description',
        'finished'
    ];
    private ?string $id;
    private string $description;
    private bool $finished;

    public function __construct()
    {
        $this->id = null;
        $this->finished = false;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        if (!isset($this->id) && is_null($this->id)) {
            $this->id = $id;
        }
        return $this;
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
}
