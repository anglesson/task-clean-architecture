<?php

namespace Anglesson\Task\Application\Api;

use Anglesson\Task\Application\Exceptions\MissingParamsErrorException;
use Anglesson\Task\Application\Protocols\Http\Controller;
use Anglesson\Task\Domain\Protocols\CreateTaskService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Anglesson\Task\Application\DTO\TaskDTO;

class CreateTaskController implements Controller
{
    private CreateTaskService $service;

    public function __construct(CreateTaskService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Response $response): Response
    {
        if (!$request->getParsedBody()) {
            throw new MissingParamsErrorException();
        }
        $dataDTO = TaskDTO::fromRequest($request);
        $task = $this->service->create($dataDTO);
        $response->getBody()->write($task->jsonSerialize());
        return $response;
    }
}
