<?php

namespace Test\Main\Factories;

use App\ToDo\Application\Api\ReadTaskController;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Main\Factories\ReadTaskControllerFactory;
use PHPUnit\Framework\TestCase;

class ReadTaskControllerFactoryTest extends TestCase
{
    public function testShouldReturnsAReadTaskController()
    {
        $repositoryMock = $this->createMock(ITaskRepository::class);
        $readTaskController = new ReadTaskControllerFactory();
        $this->assertInstanceOf(ReadTaskController::class, $readTaskController->create($repositoryMock));
    }
}
