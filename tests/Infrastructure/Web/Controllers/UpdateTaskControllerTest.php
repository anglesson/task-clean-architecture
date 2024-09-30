<?php

namespace Test\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\UpdateTaskController;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCase;
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

        $presenter = $this->createMock(UpdateTaskPresenter::class);
        $service = $this->createMock(UpdateTaskUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($data);

        $controller = new UpdateTaskController($service, $presenter);
        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $presenter = $this->createMock(UpdateTaskPresenter::class);
        $service = $this->createMock(UpdateTaskUseCase::class);
        $controller = new UpdateTaskController($service, $presenter);
        $controller->handle($this->request, $this->response);
    }
}
