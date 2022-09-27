<?php

namespace Test\Application\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Anglesson\Task\Application\Exceptions\MissingParamsErrorException;
use Anglesson\Task\Application\Api\CreateTaskController;
use Anglesson\Task\Domain\Protocols\CreateTaskService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Anglesson\Task\Application\DTO\TaskDTO;

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

        $taskDTO = TaskDTO::fromRequest($this->request);

        $service = $this->createMock(CreateTaskService::class);
        $service
            ->expects($this->once())
            ->method('create')
            ->with($taskDTO);

        $controller = new CreateTaskController($service);

        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsErrorException::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(CreateTaskService::class);
        $controller = new CreateTaskController($service);
        $controller->handle($this->request, $this->response);
    }
}
