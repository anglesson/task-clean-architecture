<?php

namespace Test\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class CreateTaskControllerTest extends TestCase
{
    /** @var ServerRequestInterface&\PHPUnit\Framework\MockObject\MockObject $request */
    private $request;

    /** @var ResponseInterface&\PHPUnit\Framework\MockObject\MockObject $response */
    private $response;

    protected function setUp(): void
    {
        $this->request = $this->createStub(ServerRequestInterface::class);
        $this->response = $this->createStub(ResponseInterface::class);

        $streamStub = $this->createStub(StreamInterface::class);
        $this->response->method('getBody')->willReturn($streamStub);
    }

    public function testShouldCallServiceWithCorrectValues()
    {
        $data = ['description' => 'My description'];

        $this->request->method('getParsedBody')->willReturn($data);

        $inputCreateTask = InputCreateTask::create($data);
        $presenter = $this->createMock(CreateTaskPresenter::class);
        $service = $this->createMock(CreateTaskUseCase::class);
        $service->expects($this->once())->method('execute')->with($inputCreateTask);

        $controller = new CreateTaskController($service, $presenter);
        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(CreateTaskUseCase::class);
        $presenter = $this->createMock(CreateTaskPresenter::class);
        $controller = new CreateTaskController($service, $presenter);
        $controller->handle($this->request, $this->response);
    }
}
