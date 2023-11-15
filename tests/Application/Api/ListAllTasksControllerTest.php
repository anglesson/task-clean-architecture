<?php

namespace Application\Api;

use App\ToDo\Application\Api\ListTasksController;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenter;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCase;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface as Stream;

class ListAllTasksControllerTest extends TestCase
{
    use ProphecyTrait;
    private Request $request;
    private Response $response;
    private Stream $stream;

    public function setUp(): void
    {
        $this->request = $this->createStub(Request::class);
        $this->response = $this->createStub(Response::class);
        $this->stream = $this->createStub(Stream::class);
        $this->response->method('getBody')->willReturn($this->stream);
    }

    public function testShouldBeAnInstanceOfController()
    {
        $service = $this->createStub(ListTasksUseCase::class);
        $presenter = $this->createStub(ListTaskPresenter::class);
        $controller = new ListTasksController($service, $presenter);
        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testShouldReturnAResponse()
    {
        $this->response->method('getBody')->willReturnSelf();
        $service = $this->createStub(ListTasksUseCase::class);
        $presenter = $this->createStub(ListTaskPresenter::class);
        $controller = new ListTasksController($service, $presenter);
        $response = $controller->handle($this->request, $this->response);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShouldCallServiceFindAllTasks()
    {
        $service = $this->prophesize(ListTasksUseCase::class);
        $presenter = $this->createStub(ListTaskPresenter::class);
        $service->execute()->shouldBeCalled();
        (new ListTasksController($service->reveal(), $presenter))->handle($this->request, $this->response);
    }

    public function testShouldReturn200IfSuccess()
    {
        $service = $this->createStub(ListTasksUseCase::class);
        $presenter = $this->createStub(ListTaskPresenter::class);
        $localReponse = $this->createMock(Response::class);
        $localReponse->method('getBody')->willReturn($this->stream);
        $localReponse
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);
        $controller = new ListTasksController($service, $presenter);

        $response = $controller->handle($this->request, $localReponse);
        $this->assertSame(200, $response->getStatusCode());
    }
}
