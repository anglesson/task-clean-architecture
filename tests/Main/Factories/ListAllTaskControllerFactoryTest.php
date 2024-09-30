<?php

namespace Test\Main\Factories;

use App\ToDo\Infrastructure\Web\Controllers\ListTasksController;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use PHPUnit\Framework\TestCase;

class ListAllTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAListAllTaskController()
    {
        $this->assertInstanceOf(ListTasksController::class, ListAllTasksControllerFactory::create());
    }
}
