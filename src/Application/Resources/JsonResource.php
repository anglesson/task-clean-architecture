<?php

namespace App\ToDo\Application\Resources;

class JsonResource
{
    public static function create($data): string
    {
        return json_encode([
            'data' => $data
        ]);
    }
}
