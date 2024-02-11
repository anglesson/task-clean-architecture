<?php

namespace App\ToDo\Main\Factories;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\Web\HomeController;

final class HomeControllerFactory
{
    public static function create(): Controller
    {
        return new HomeController();
    }
}
