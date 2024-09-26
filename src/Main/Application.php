<?php

namespace App\ToDo\Main;

use App\ToDo\Infrastructure\ErrorHandling\ErrorHandlerInterface;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Utils\LoadEnvInterface;

class Application
{
    private HttpServer            $httpServer;
    private ErrorHandlerInterface $errorHandler;
    private LoadEnvInterface      $loadEnv;

    public function __construct()
    {
        $this->errorHandler = CompositionRoot::createErrorHandler();
        $this->loadEnv      = CompositionRoot::createLoadEnv();
        $this->httpServer   = CompositionRoot::createServer();
    }

    public function start(): void
    {
        $this->errorHandler->register();
        $this->loadEnv->load();

        $this->httpServer->listen();
    }
}
