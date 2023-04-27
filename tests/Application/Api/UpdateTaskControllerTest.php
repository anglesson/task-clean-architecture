<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Application\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\UpdateTask\IUpdateTaskUseCase;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class UpdateTaskControllerTest extends TestCase
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
        $data = InputUpdateTask::create([
            'id'          => 'any_id',
            'description' => 'My description',
            'finished'    => false
        ]);

        $this->request
            ->method('getParsedBody')
            ->willReturn([
                'description' => 'My description',
                'finished'    => false
            ]);

        $this->request
            ->method('getAttribute')
            ->with('id')
            ->willReturn($data->id);

        $service = $this->createMock(IUpdateTaskUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($data);

        $controller = new UpdateTaskController($service);
        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(IUpdateTaskUseCase::class);
        $controller = new UpdateTaskController($service);
        $controller->handle($this->request, $this->response);
    }
}
