<?php 
namespace App\ToDo\Infrastructure\Utils;

class Environment {
    public static function load($dir) {
        if (!\file_exists($dir.'/.env')) {
            return false;
        }

        $vars = file($dir.'/.env');
        foreach ($vars as $var) {
            \putenv(trim($var));
        }
    }
}