<?php

namespace Test\Main\Factories;

use App\ToDo\Infrastructure\Web\Controllers\CreateTaskListController;
use App\ToDo\Main\Factories\CreateTaskListControllerFactory;
use PHPUnit\Framework\TestCase;

class CreateTaskListControllerFactoryTest extends TestCase
{
    public function testShouldReturnsACreateTaskListController()
    {
        $this->assertInstanceOf(CreateTaskListController::class, CreateTaskListControllerFactory::create());
    }
}
