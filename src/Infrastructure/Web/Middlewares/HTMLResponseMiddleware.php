<?php

namespace App\ToDo\Infrastructure\Web\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HTMLResponseMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $modifiedResponse = $response->withoutHeader('Content-Type');
        $modifiedResponse = $response->withHeader('Content-Type', 'text/html');
        return $modifiedResponse;
    }
}
