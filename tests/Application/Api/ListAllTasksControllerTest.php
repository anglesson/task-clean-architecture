<?php

namespace Application\Api;

use App\ToDo\Application\Api\ListaAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Protocols\ListAllTasksService;
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
        $service = $this->createStub(ListAllTasksService::class);
        $controller = new ListaAllTaskController($service);
        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testShouldReturnAResponse()
    {
        $this->response->method('getBody')->willReturnSelf();
        $service = $this->createStub(ListAllTasksService::class);
        $controller = new ListaAllTaskController($service);
        $response = $controller->handle($this->request, $this->response);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShouldCallServiceFindAllTasks()
    {
        $service = $this->prophesize(ListAllTasksService::class);
        $service->list()->shouldBeCalled();
        (new ListaAllTaskController($service->reveal()))->handle($this->request, $this->response);
    }
}
