<?php

namespace Anglesson\Task\Application\Api;

use Anglesson\Task\Application\Protocols\Http\Controller;
use Anglesson\Task\Application\Utils\TaskMapper;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TaskCreateController
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
        $taskSaved = $this->action->create($task);
        $response->getBody()->write($taskSaved);
        return $response;
    }
}
