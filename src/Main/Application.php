<?php

namespace App\ToDo\Main;

use App\ToDo\Main\CompositionRoot;

class Application
{
    public function start(): void
    {
        $httpServer = CompositionRoot::createServer();
        $httpServer->registerRoutes();
        $httpServer->listen();
    }
}
