<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class ReadTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAReadTaskController()
    {
        $readTaskController = new ReadTaskControllerFactory();
        $this->assertInstanceOf(ReadTaskController::class, $readTaskController->create());
    }
}
