<?php

namespace Test\Main\Factories;

use App\ToDo\Infrastructure\Web\Controllers\CreateTaskController;
use App\ToDo\Main\Factories\CreateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskController()
    {
        $this->assertInstanceOf(CreateTaskController::class, CreateTaskControllerFactory::create());
    }
}
