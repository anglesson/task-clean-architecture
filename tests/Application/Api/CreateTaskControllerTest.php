<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
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
