<?php

namespace App\ToDo\Main\Factories;
use App\ToDo\Infrastructure\Web\Controllers\Controller;
use App\ToDo\Infrastructure\Web\Controllers\HomeController;

final class HomeControllerFactory
{
    public static function create(): Controller
    {
        return new HomeController();
    }
}
