<?php

namespace Test\Infrastructure\Http\Slim\Adpters;

use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Infrastructure\Http\Slim\Adapters\SlimControllerAdapter;
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
