<?php

namespace Test\Main\Adpters;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\MiddlewareInterface;
use Slim\App;
use Slim\Interfaces\RouteInterface;

class SlimHttpServerAdapterTest extends TestCase
{
    public function testShouldBeRegisterRoute()
    {
        $method = 'get';
        $url = '/any/url';
        $controller = $this->createMock(Controller::class);

        $slimMock = $this->createMock(App::class);
        $slimMock
            ->expects($this->once())
            ->method('get')
            ->with('/any/url', $this->anything());

        $sut = new SlimHttpServerAdapter($slimMock);
        $sut->register($method, $url, $controller);
    }

    public function testShouldBeRegisterAMiddlewareOnRoute()
    {
        $method = 'get';
        $url = '/any/url';
        $controller = $this->createMock(Controller::class);
        $middlwares = [$this->createMock(MiddlewareInterface::class)];

        $route = $this->createMock(RouteInterface::class);
        $route->expects($this->once())
            ->method('add')
            ->with($middlwares[0]);

        $slimMock = $this->createMock(App::class);
        $slimMock
            ->method('get')
            ->willReturn($route);

        $sut = new SlimHttpServerAdapter($slimMock);
        $sut->register($method, $url, $controller, $middlwares);
    }
}
