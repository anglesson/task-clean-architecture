<?php
namespace App\ToDo\Main\Adapters\Slim;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\Protocols\Http\HttpServer;
use Slim\App;
use Slim\Factory\AppFactory;

class SlimHttpServerAdapter implements HttpServer
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->app->addBodyParsingMiddleware();
    }

    public function register(string $method, string $url, Controller $controller, $middlewares = []): void
    {
        $route = $this->app->{$method}($url, new SlimControllerAdapter($controller));
        if (!empty($middlewares)) {
            foreach ($middlewares as $middleware) {
                $route->add($middleware);
            }
        }
    }

    public function applyMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            $this->app->add($middleware);
        }
    }

    public function listen(): void
    {
        $this->app->run();
    }

}