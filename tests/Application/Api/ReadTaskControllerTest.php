<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\FindTask\FindTaskService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class ReadTaskControllerTest extends TestCase
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
        $attribute = 'any_value';

        $this->request
            ->method('getAttribute')
            ->willReturn($attribute);

        $service = $this->createMock(FindTaskService::class);
        $service
            ->expects($this->once())
            ->method('find')
            ->with($attribute);

        $controller = new ReadTaskController($service);

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
