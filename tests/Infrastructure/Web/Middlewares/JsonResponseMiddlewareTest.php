<?php

namespace Test\Infrastructure\Web\Middlewares;

use App\ToDo\Infrastructure\Web\Middlewares\JsonResponseMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JsonResponseMiddlewareTest extends TestCase
{
    public function testShouldBeAddHeadersToResponse()
    {
        $request = $this->createMock(Request::class);

        $response = $this->createMock(Response::class);
        $response
            ->expects($this->once())
            ->method('withHeader')
            ->with('Content-Type', 'application/json')
            ->willReturn($this->returnSelf());

        $handler = $this->createMock(RequestHandler::class);
        $handler->expects($this->once())
            ->method('handle')
            ->with($request)
            ->willReturn($response);

        $jsonResponseMiddleware = new JsonResponseMiddleware();

        $jsonResponseMiddleware->process($request, $handler);
    }
}
