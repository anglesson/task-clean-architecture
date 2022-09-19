<?php

namespace Anglesson\Task\Application\Api;

use Anglesson\Task\Application\Protocols\Http\Controller;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TaskCreateController implements Controller
{
    private CreateTaskServiceInterface $service;

    public function __construct(CreateTaskServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Response $response): Response
    {
        $params = $request->getParsedBody();
        $task = $this->service->create($params);
        $response->getBody()->write($task->__toString());
        return $response;
    }
}
