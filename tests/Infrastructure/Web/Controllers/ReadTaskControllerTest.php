<?php

namespace Test\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\ReadTaskController;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCase;
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

        $presenter = $this->createMock(ReadTaskPresenter::class);
        $service = $this->createMock(ReadTaskUseCase::class);
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
        $service = $this->createMock(ReadTaskUseCase::class);
        $presenter = $this->createMock(ReadTaskPresenter::class);
        $controller = new ReadTaskController($service, $presenter);
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
