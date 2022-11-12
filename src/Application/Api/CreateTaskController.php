<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Domain\Services\CreateTask\InputCreateTask;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateTaskController implements Controller
{
    private CreateTaskService $service;

    public function __construct(CreateTaskService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        if (!$data) {
            throw new MissingParamsError();
        }
        $inputCreateTask = new InputCreateTask($data);
        $task = $this->service->create($inputCreateTask);
        $response->getBody()->write($task->jsonSerialize());
        return $response;
    }
}
