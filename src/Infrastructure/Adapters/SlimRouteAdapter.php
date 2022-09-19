<?php

namespace Anglesson\Task\Infrastructure\Adapters;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Anglesson\Task\Application\Protocols\Http\Controller;
use Error;

final class SlimRouteAdapter
{
    protected Controller $controller;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try {
            $controllerResponse = $this->controller->handle($request, $response);
            return $controllerResponse->withHeader('Content-type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(\json_encode(['Erro' => $e->getMessage()]));
            return $response;
        }
    }
}
