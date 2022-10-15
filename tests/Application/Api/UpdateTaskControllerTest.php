<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\UpdateTaskController;
use App\ToDo\Domain\Protocols\UpdateTaskService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Exceptions\MissingParamsError;

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
        $id = 'any_id';
        $data = [
            'description' => 'My description',
            'finished' => false
        ];

        $this->request
            ->method('getParsedBody')
            ->willReturn($data);

        $this->request
            ->method('getAttribute')
            ->with('id')
            ->willReturn($id);

        $service = $this->createMock(UpdateTaskService::class);
        $service
            ->expects($this->once())
            ->method('update')
            ->with($id, $data);

        $controller = new UpdateTaskController($service);
        $controller->handle($this->request, $this->response);
    }

    public function testShouldBeThrowsMissingParamsErrorIfParamsNotFound()
    {
        $this->expectException(MissingParamsError::class);
        $this->request->method('getParsedBody')->willReturn(null);
        $service = $this->createMock(UpdateTaskService::class);
        $controller = new UpdateTaskController($service);
        $controller->handle($this->request, $this->response);
    }
}
