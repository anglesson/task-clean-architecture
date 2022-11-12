<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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

        $this->request->method('getParsedBody')->willReturn($data);

        $inputCreateTask = new InputCreateTask($data);
        $service = $this->createMock(ICreateTaskUseCase::class);
        $service->expects($this->once())->method('create')->with($inputCreateTask);

        $controller = new CreateTaskController($service);
        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(ICreateTaskUseCase::class);
        $controller = new CreateTaskController($service);
        $controller->handle($this->request, $this->response);
    }
}
