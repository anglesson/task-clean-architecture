<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteTaskController implements Controller
{
    private DeleteTaskService $deleteTaskService;

    public function __construct(DeleteTaskService $deleteTaskService)
    {
        $this->deleteTaskService = $deleteTaskService;
    }

    public function handle(Request $request, Response $response): Response
    {
        $idTask = $request->getAttribute('id');
        $this->deleteTaskService->delete($idTask);
        return $response->withStatus(204);
    }
}
