<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\CreateList\CreateListUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateListController implements Controller
{
    private CreateListUseCase $createListUseCase;

    public function __construct($service)
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
