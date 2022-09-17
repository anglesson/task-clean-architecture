<?php

namespace Anglesson\Task\Application\Api;

use Anglesson\Task\Application\Protocols\Http\Controller;
use Anglesson\Task\Application\Utils\TaskMapper;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class TaskCreateController implements Controller
{
    private CreateTaskServiceInterface $action;

    public function __construct(CreateTaskServiceInterface $action)
    {
        $this->action = $action;
    }

    public function handle(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $task = TaskMapper::toDomain($data);
        $this->action->create($task);
        return $response->withStatus(201);
    }
}
