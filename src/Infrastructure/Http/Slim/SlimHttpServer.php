<?php

namespace App\ToDo\Infrastructure\Http\Slim;

use App\ToDo\Infrastructure\Web\Controllers\ListTasksController;
use App\ToDo\Infrastructure\Web\Middlewares\JsonResponseMiddleware;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Infrastructure\Web\Controllers\CreateTaskListController;
use App\ToDo\Infrastructure\Web\Controllers\DeleteTaskController;
use App\ToDo\Infrastructure\Web\Controllers\HomeController;
use App\ToDo\Infrastructure\Web\Controllers\ReadTaskController;
use App\ToDo\Infrastructure\Web\Controllers\UpdateTaskController;
use App\ToDo\Infrastructure\Web\Middlewares\JsonBodyParserMiddleware;
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
        $this->app->get('/', HomeController::class . ':handle');

        $this->app->group('/api', function (RouteCollectorProxy $group) {
            $group->post('/tasks', CreateTaskController::class . ':handle');
            $group->get('/tasks/{id}', ReadTaskController::class . ':handle');
            $group->get('/tasks', ListTasksController::class . ':handle');
            $group->put('/tasks/{id}', UpdateTaskController::class . ':handle');
            $group->delete('/tasks/{id}', DeleteTaskController::class . ':handle');

            $group->post('/task-list', CreateTaskListController::class . ':handle');
        })->addMiddleware(new JsonResponseMiddleware())->addMiddleware(new JsonBodyParserMiddleware());
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
