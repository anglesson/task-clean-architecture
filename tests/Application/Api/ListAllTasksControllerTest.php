<?php

namespace Application\Api;

use App\ToDo\Application\Api\ListaAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ListAllTasksControllerTest extends TestCase
{
    public function testShouldBeAnInstanceOfController()
    {
        $controller = new ListaAllTaskController();
        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testShouldReturnAResponse()
    {
        $request = $this->createStub(ServerRequestInterface::class);
        $response = $this->createStub(ResponseInterface::class);
        $controller = new ListaAllTaskController();
        $response = $controller->handle($request, $response);
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
