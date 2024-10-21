<?php

namespace App\ToDo\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\Controller;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateTaskListController implements Controller
{
    private CreateTaskListUseCase $createListUseCase;

    public function __construct(CreateTaskListUseCase $service)
    {
        $this->createListUseCase = $service;
    }
    public function handle(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $output = $this->createListUseCase->execute($body['name']);
        $response->getBody()->write($output->toJson());
        return $response;
    }
}
