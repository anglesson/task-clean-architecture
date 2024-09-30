<?php

namespace Test\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\DeleteTaskController;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCase;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface as Stream;

class DeleteTaskControllerTest extends TestCase
{
    protected Request $request;
    protected Response $response;

    protected function setUp(): void
    {
        $streamStub = $this->createStub(Stream::class);
        $requestStub = $this->createStub(Request::class);
        $responseStub = $this->createStub(Response::class);
        $responseStub->method('getBody')->willReturn($streamStub);

        $this->request = $requestStub;
        $this->response = $responseStub;
    }

    public function testShouldCallServiceWithCorrectIdValue()
    {
        $id = 'any_id';

        $this->request
            ->method('getAttribute')
            ->willReturn($id);

        $this->response
            ->method('withStatus')
            ->willReturnSelf();

        $service = $this->createMock(DeleteTaskUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($id);

        (new DeleteTaskController($service))
            ->handle($this->request, $this->response);
    }

    public function testShouldReturn204IfTaskWasDeleteWithSuccess()
    {
        $id = 'any_id';
        $statusCodeExpected = 204;

        $this->request
            ->method('getAttribute')
            ->with('id')
            ->willReturn($id);

        $this->response
            ->method('withStatus')
            ->with($statusCodeExpected)
            ->willReturnSelf();

        $this->response
            ->method('getStatusCode')
            ->willReturn($statusCodeExpected);

        $service = $this->createMock(DeleteTaskUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($id);

        $response = (new DeleteTaskController($service))->handle($this->request, $this->response);
        $this->assertSame($statusCodeExpected, $response->getStatusCode());
    }
}
