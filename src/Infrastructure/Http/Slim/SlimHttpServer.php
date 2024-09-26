<?php

namespace App\ToDo\Infrastructure\Http\Slim;

use App\ToDo\Application\Middlewares\JsonResponseMiddleware;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Http\Slim\Adapters\SlimControllerAdapter;
use App\ToDo\Infrastructure\Http\Slim\Middlewares\JsonBodyParserMiddleware;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class SlimHttpServer implements HttpServer
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    private function registerRoutes(): void
    {
        $this->app->addRoutingMiddleware();

        $this->app->group('/api', function (RouteCollectorProxy $group) {
            $group->post('/tasks', new SlimControllerAdapter(CreateTaskControllerFactory::create()));
            $group->get('/tasks/{id}', new SlimControllerAdapter(ReadTaskControllerFactory::create()));
            $group->get('/tasks', new SlimControllerAdapter(ListAllTasksControllerFactory::create()));
            $group->put('/tasks/{id}', new SlimControllerAdapter(UpdateTaskControllerFactory::create()));
            $group->delete('/tasks/{id}', new SlimControllerAdapter(DeleteTaskControllerFactory::create()));
        })->addMiddleware(new JsonResponseMiddleware())
            ->addMiddleware(new JsonBodyParserMiddleware());
    }

    /**
     * @inheritDoc
     */
    public function listen(): void
    {
        $this->registerRoutes();
        $this->app->run();
    }
}
