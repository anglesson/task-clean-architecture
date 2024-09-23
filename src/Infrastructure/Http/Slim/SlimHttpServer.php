<?php

namespace App\ToDo\Infrastructure\Http\Slim;

use App\ToDo\Application\Middlewares\JsonResponseMiddleware;
use App\ToDo\Domain\Protocols\TaskRepository;
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
    private App            $app;
    private TaskRepository $repository;

    public function __construct(
        App $app,
        $repository,
    ) {
        $this->app        = $app;
        $this->repository = $repository;
    }

    public function registerRoutes(): void
    {
        $this->app->group('/api', function (RouteCollectorProxy $group) {
            $group->post('/tasks', new SlimControllerAdapter(CreateTaskControllerFactory::create($this->repository)));
            $group->get('/tasks/{id}', new SlimControllerAdapter(ReadTaskControllerFactory::create($this->repository)));
            $group->get('/tasks', new SlimControllerAdapter(ListAllTasksControllerFactory::create($this->repository)));
            $group->put('/tasks/{id}', new SlimControllerAdapter(UpdateTaskControllerFactory::create($this->repository)));
            $group->delete('/tasks/{id}', new SlimControllerAdapter(DeleteTaskControllerFactory::create($this->repository)));
        })->addMiddleware(new JsonResponseMiddleware())
        ->addMiddleware(new JsonBodyParserMiddleware());
    }

    /**
     * @inheritDoc
     */
    public function listen(): void
    {
        $this->app->run();
    }
}
