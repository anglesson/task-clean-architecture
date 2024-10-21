<?php

namespace App\ToDo\Infrastructure\Web\Resources;

class JsonResource
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __toString(): string
    {
        return json_encode($this->data);
    }
}
