<?php

namespace DTO;

final class TaskDto extends BaseDTO
{
    public static string $description;
    public static bool $finished;

    public static function map(array $data)
    {
        self::$description = $data['description'] ?? '';
        self::$finished = $data['finished'] ?? '';
    }
}
