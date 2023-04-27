<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\DeleteTask\IDeleteTaskUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteTaskController implements Controller
{
    private IDeleteTaskUseCase $deleteTaskService;

    public function __construct(IDeleteTaskUseCase $deleteTaskService)
    {
        $this->deleteTaskService = $deleteTaskService;
    }

    public function handle(Request $request, Response $response): Response
    {
        $idTask = $request->getAttribute('id');
        $this->deleteTaskService->execute($idTask);
        return $response->withStatus(204);
    }
}
