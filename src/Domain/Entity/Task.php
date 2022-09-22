<?php

namespace Anglesson\Task\Domain\Entity;

use Anglesson\Task\Domain\Utils\Fillable;
use Anglesson\Task\Domain\Exceptions\DescriptionHasMoreThan50Caracters;

class Task
{
    use Fillable;
    
    private $fillable = [
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

    public function setId(string $id): void
    {
        if (!isset($this->id) && is_null($this->id)) {
            $this->id = $id;
        }
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        if (strlen($description) > 50) {
            throw new DescriptionHasMoreThan50Caracters();
        }
        $this->description = $description;
    }

    public function getFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished)
    {
        $this->finished = $finished;
    }
}
