<?php

namespace App\ToDo\Infrastructure\Api;

use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;

class Router
{
    private HttpServer $httpServer;

    public function __construct(HttpServer $httpServer)
    {
        $this->httpServer = $httpServer;
    }

    public function init(): void
    {
        $this->httpServer->register('post', '/api/task', CreateTaskControllerFactory::create());
        $this->httpServer->register('get','/api/task/{id}', ReadTaskControllerFactory::create());
        $this->httpServer->register('get','/api/task', ListAllTasksControllerFactory::create());
        $this->httpServer->register('put','/api/task/{id}', UpdateTaskControllerFactory::create());
        $this->httpServer->register('delete','/api/task/{id}', DeleteTaskControllerFactory::create());
    }
}
