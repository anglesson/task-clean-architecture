<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\CreateTaskController;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskController()
    {
        $this->assertInstanceOf(CreateTaskController::class, CreateTaskControllerFactory::create());
    }
}
