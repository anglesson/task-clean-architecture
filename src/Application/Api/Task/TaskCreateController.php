<?php

use Anglesson\Exemplo\Application\Protocols\Http\Controller;
use Anglesson\Exemplo\Domain\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DTO\TaskDto;
use Anglesson\Exemplo\Utils\TaskMapper;

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
        $taskSaved = $this->action->create();
        return $response->setBody(json_encode($taskSaved))->getBody();
    }
}