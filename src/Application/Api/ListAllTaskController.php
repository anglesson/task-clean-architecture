<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\ListAllTasks\ListAllTasksService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListAllTaskController implements Controller
{
    public function __construct(
        private readonly ListAllTasksService $service
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $allTasks = $this->service->list();
        $response->getBody()->write(json_encode($allTasks, true));
        return $response;
    }
}
