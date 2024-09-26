<?php

namespace App\ToDo\Infrastructure\Utils;

class Environment implements LoadEnvInterface
{
    public static $ENV_FILE = null;

    public function __construct()
    {
        self::$ENV_FILE = $_SERVER['DOCUMENT_ROOT'] . "/../.env";
    }

    public function load(): void
    {
        if (!file_exists(self::$ENV_FILE)) {
            throw new \Exception("File .env not found", 500);
        }

        $vars = file(self::$ENV_FILE);
        foreach ($vars as $var) {
            \putenv(trim($var));
        }
    }
}
