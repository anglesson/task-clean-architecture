<?php

namespace App\ToDo\Main\Adapters\Slim;

use App\ToDo\Application\Protocols\Http\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class SlimControllerAdapter
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
        } catch (\Throwable $e) {
            $code = ($e->getCode() >= 100 && $e->getCode() <= 100) ? $e->getCode() : 500;
            $response->getBody()->write(\json_encode(['error' => [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]], JSON_PRETTY_PRINT));
            return $response->withStatus($code)->withHeader('Content-type', 'application/json');
        }
    }
}
