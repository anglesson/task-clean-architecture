<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Presenters\CreateTask\ICreateTaskPresenter;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReadTaskController implements Controller
{
    public function __construct(
        private readonly ReadTaskUseCase $service,
        private readonly ICreateTaskPresenter $presenter
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $output = $this->service->execute($id);
        $response->getBody()->write((string) $this->presenter->toJson($output));
        return $response;
    }
}
