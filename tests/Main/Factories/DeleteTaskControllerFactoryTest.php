<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\DeleteTaskController;
use App\ToDo\Main\Factories\DeleteTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class DeleteTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsADeleteTaskController()
    {
        $this->assertInstanceOf(DeleteTaskController::class, DeleteTaskControllerFactory::create());
    }
}
