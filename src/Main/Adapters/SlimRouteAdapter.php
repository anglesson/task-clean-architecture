<?php

namespace App\ToDo\Main\Adapters;

use Error;
use App\ToDo\Application\Protocols\Http\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class SlimRouteAdapter
{
    protected Controller $controller;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try {
            $controllerResponse = $this->controller->handle($request, $response);
            return $controllerResponse->withHeader('Content-type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(\json_encode(['Erro' => $e->getMessage()], JSON_PRETTY_PRINT));
            return $response->withStatus($e->getCode())->withHeader('Content-type', 'application/json');
        }
    }
}
