<?php

namespace App\ToDo\Infrastructure\Http\Slim;

use App\ToDo\Infrastructure\Web\Middlewares\JsonResponseMiddleware;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Http\Slim\Adapters\SlimControllerAdapter;
use App\ToDo\Infrastructure\Http\Slim\Middlewares\JsonBodyParserMiddleware;
use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Infrastructure\Web\Controllers\DeleteTaskController;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\HomeControllerFactory;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use App\ToDo\Infrastructure\Web\Controllers\ReadTaskController;
use App\ToDo\Infrastructure\Web\Controllers\UpdateTaskController;
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
            $group->post('/tasks', CreateTaskController::class.':handle');
            $group->get('/tasks/{id}', ReadTaskController::class.':handle');
            $group->get('/tasks', new SlimControllerAdapter(ListAllTasksControllerFactory::create()));
            $group->put('/tasks/{id}', UpdateTaskController::class.':handle');
            $group->delete('/tasks/{id}', DeleteTaskController::class.':handle');
        })->addMiddleware(new JsonResponseMiddleware())
            ->addMiddleware(new JsonBodyParserMiddleware());
        $this->app->get('/', new SlimControllerAdapter(HomeControllerFactory::create()));
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
