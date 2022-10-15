<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\Protocols\UpdateTaskService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateTaskController implements Controller
{
    private UpdateTaskService $service;

    public function __construct(UpdateTaskService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Response $response): Response
    {
        if (!$request->getParsedBody()) {
            throw new MissingParamsError();
        }
        $task = $this->service->update($request->getAttribute('id'), $request->getParsedBody());
        $response->getBody()->write($task->jsonSerialize());
        return $response;
    }
}
