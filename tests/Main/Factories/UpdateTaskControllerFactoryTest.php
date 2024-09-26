<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Controllers\UpdateTaskController;
use App\ToDo\Main\Factories\UpdateTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class UpdateTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAUpdateTaskController()
    {
        $this->assertInstanceOf(UpdateTaskController::class, UpdateTaskControllerFactory::create());
    }
}
