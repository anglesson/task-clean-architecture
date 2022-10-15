<?php

namespace Application\Api;

use App\ToDo\Application\Api\ListaAllTaskController;
use App\ToDo\Application\Protocols\Http\Controller;
use PHPUnit\Framework\TestCase;

class ListAllTasksControllerTest extends TestCase
{
    public function testShouldBeAnInstanceOfController()
    {
        $controller = new ListaAllTaskController();
        $this->assertInstanceOf(Controller::class, $controller);
    }
}
