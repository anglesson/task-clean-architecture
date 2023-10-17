<?php

namespace App\ToDo\Application\Resources;

class JsonResource
{
    private static mixed $data;

    private function __construct($data)
    {
        self::$data = $data;
    }

    public static function create($data): static
    {
        return new self($data);
    }

    public function __toString()
    {
        return json_encode([
            'data' => self::$data
        ]);
    }
}
