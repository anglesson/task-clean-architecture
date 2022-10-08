<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\DTO\TaskDTO;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Application\Protocols\Http\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\ToDo\Application\Exceptions\MissingParamsErrorException;

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
