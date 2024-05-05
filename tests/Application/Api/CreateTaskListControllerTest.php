<?php

namespace Test\Application\Api;

use App\ToDo\Application\Api\CreateListController;
use App\ToDo\Application\Api\CreateTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateList\CreateListUseCase;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class CreateTaskListControllerTest extends TestCase
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
        $data = ['name' => 'My First List'];

        $this->request->method('getParsedBody')->willReturn($data);

        $service = $this->createMock(CreateListUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($data['name']);

        $controller = new CreateListController($service);
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
