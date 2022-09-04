<?php

namespace Anglesson\Exemplo\Application\Api;

use Anglesson\Exemplo\Application\Protocols\Http\Controller;
use Anglesson\Exemplo\Application\Utils\TaskMapper;
use Anglesson\Exemplo\Domain\Protocols\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TaskCreateController
{
    private CreateTaskServiceInterface $action;

    public function __construct(CreateTaskServiceInterface $action)
    {
        $this->action = $action;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $task = TaskMapper::toDomain($data);
        $taskSaved = $this->action->create($task);
        $response->getBody()->write($taskSaved);
        return $response;
    }
}