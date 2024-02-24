<?php

namespace Test\Main\Adpters;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Main\Adapters\Slim\SlimHttpServerAdapter;
use PHPUnit\Framework\TestCase;
use Slim\App;

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
            ->with($url, $this->anything());

        $sut = new SlimHttpServerAdapter($slimMock);
        $sut->register($method, $url, $controller);
    }

}
