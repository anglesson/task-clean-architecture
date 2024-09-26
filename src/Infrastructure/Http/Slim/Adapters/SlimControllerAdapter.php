<?php

namespace App\ToDo\Infrastructure\Http\Slim\Adapters;

use App\ToDo\Application\Controllers\Controller;
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
        return $this->controller->handle($request, $response);
    }
}
