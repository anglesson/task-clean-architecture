<?php

namespace Test\Application\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use App\ToDo\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Domain\Exceptions\MissingParamsError;

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
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(CreateTaskService::class);
        $controller = new CreateTaskController($service);
        $controller->handle($this->request, $this->response);
    }
}
