<?php

use Anglesson\Exemplo\Application\Protocols\Http\Controller;
use Anglesson\Exemplo\Domain\CreateTaskServiceInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DTO\TaskDto;

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
        $taskDto = (new TaskDto())->description;
        $taskSaved = $this->action->create();
        return $response->setBody(json_encode($taskSaved))->getBody();
    }
}