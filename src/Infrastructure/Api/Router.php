<?php

namespace App\ToDo\Infrastructure\Api;

use App\ToDo\Application\Protocols\Http\HttpServer;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;

class Router
{
    private HttpServer $httpServer;
    private ITaskRepository $repository;

    public function __construct(HttpServer $httpServer, ITaskRepository $repository)
    {
        $this->httpServer = $httpServer;
        $this->repository = $repository;
    }

    public function init(): void
    {
        $this->httpServer->register('post', '/api/task', CreateTaskControllerFactory::create($this->repository));
        $this->httpServer->register('get', '/api/task/{id}', ReadTaskControllerFactory::create($this->repository));
        $this->httpServer->register('get', '/api/task', ListAllTasksControllerFactory::create($this->repository));
        $this->httpServer->register('put', '/api/task/{id}', UpdateTaskControllerFactory::create($this->repository));
        $this->httpServer->register('delete', '/api/task/{id}', DeleteTaskControllerFactory::create($this->repository));
    }
}
