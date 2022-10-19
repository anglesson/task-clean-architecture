<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Domain\Protocols\ListAllTasksService;
use App\ToDo\Application\Protocols\Http\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListaAllTaskController implements Controller
{
    public function __construct(
        private readonly ListAllTasksService $service
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $result = $this->service->list();
        $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT));
        return $response;
    }
}
