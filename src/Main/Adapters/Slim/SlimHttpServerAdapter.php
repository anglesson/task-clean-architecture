<?php
namespace App\ToDo\Main\Adapters\Slim;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Infrastructure\Api\HttpServer;
use Slim\Factory\AppFactory;

class SlimHttpServerAdapter implements HttpServer {

    private $app;

    public function __construct()
    {
        $this->app = AppFactory::create();
        $this->app->addBodyParsingMiddleware();
    }

    public function register(string $method, string $url, Controller $controller): void
    {
        $this->app->{$method}($url, new SlimControllerAdapter($controller));
    }

    public function listen(): void
    {
        $this->app->run();
    }
}