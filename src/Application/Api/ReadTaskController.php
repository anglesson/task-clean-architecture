<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\FindTaskService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReadTaskController implements Controller
{
    public function __construct(
       private FindTaskService $service
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $task = $this->service->find($id);
        $response->getBody()->write($task->jsonSerialize());
        return $response;
    }
}
