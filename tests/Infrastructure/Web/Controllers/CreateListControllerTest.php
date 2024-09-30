<?php

namespace Test\Infrastructure\Web\Controllers;

use App\ToDo\Infrastructure\Web\Controllers\CreateTaskListController;
use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCase;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class CreateListControllerTest extends TestCase
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

        $service = $this->createMock(CreateTaskListUseCase::class);
        $service
            ->expects($this->once())
            ->method('execute')
            ->with($data['name']);

        $controller = new CreateTaskListController($service);
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
