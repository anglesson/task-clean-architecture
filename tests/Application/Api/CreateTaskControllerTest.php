<?php

namespace Test\Application\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Anglesson\Task\Application\Exceptions\MissingParamsErrorException;
use Anglesson\Task\Application\Api\TaskCreateController;
use Anglesson\Task\Domain\Protocols\CreateTaskServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CreateTaskControllerTest extends TestCase
{
    protected ServerRequestInterface $request;
    protected ResponseInterface $response;


    protected function setUp(): void
    {
        $streamStub = $this->createStub(StreamInterface::class);
        $requestStub = $this->createStub(ServerRequestInterface::class);
        $responseStub = $this->createStub(ResponseInterface::class);
        $responseStub->method('getBody')->willReturn($streamStub);

        $this->request = $requestStub;
        $this->response = $responseStub;
    }

    public function testShouldCallServiceWithCorrectValues()
    {
        $data = ['description' => 'My description'];
        $this->request
            ->method('getParsedBody')
            ->willReturn($data);

        $service = $this->createMock(CreateTaskServiceInterface::class);
        $service
            ->expects($this->once())
            ->method('create')
            ->with($data);

        $controller = new TaskCreateController($service);

        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsErrorException::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(CreateTaskServiceInterface::class);
        $controller = new TaskCreateController($service);
        $controller->handle($this->request, $this->response);
    }
}
