<?php

namespace Test\Main\Adpters;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Main\Adapters\Slim\SlimControllerAdapter;
use PHPUnit\Framework\TestCase;

class SlimControllerAdapterTest extends TestCase
{
    public function testShouldBeACallableClass()
    {
        $controllerStub = $this->createStub(Controller::class);
        $slimControllerAdapter = new SlimControllerAdapter($controllerStub);
        $this->assertTrue(is_callable($slimControllerAdapter));
    }
}
