<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\ListAllTaskController;
use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Main\Factories\ListAllTasksControllerFactory;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class ListAllTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAListAllTaskController()
    {
        $listAllTaskController = new ListAllTasksControllerFactory();
        $this->assertInstanceOf(ListAllTaskController::class, $listAllTaskController->create());
    }
}
