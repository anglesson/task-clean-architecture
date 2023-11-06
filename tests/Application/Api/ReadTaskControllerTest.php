<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Application\Presenters\CreateTask\ICreateTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class ReadTaskControllerTest extends TestCase
{
    protected ServerRequestInterface $request;
    protected ResponseInterface $response;

    public function testShouldCallServiceWithCorrectValues()
    {
        $attribute = 'any_value';

        $this->request
            ->method('getAttribute')
            ->willReturn($attribute);

        $presenter = $this->createMock(ICreateTaskPresenter::class);
        $service = $this->createMock(IFindTaskUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($attribute);

        $controller = new ReadTaskController($service, $presenter);

        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(ICreateTaskUseCase::class);
        $presenter = $this->createMock(ICreateTaskPresenter::class);
        $controller = new CreateTaskController($service, $presenter);
        $controller->handle($this->request, $this->response);
    }

    protected function setUp(): void
    {
        $streamStub = $this->createStub(StreamInterface::class);
        $requestStub = $this->createStub(ServerRequestInterface::class);
        $responseStub = $this->createStub(ResponseInterface::class);
        $responseStub->method('getBody')->willReturn($streamStub);

        $this->request = $requestStub;
        $this->response = $responseStub;
    }
}
