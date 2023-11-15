<?php

namespace Test\Application;

use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;
use PHPUnit\Framework\TestCase;

class CreateTaskPresenterTest extends TestCase
{
    public function testShouldImplementsACreateTaskPresenterInterface()
    {
        $outputStub = $this->createStub(OutputCreateTask::class);

        $sut = new CreateTaskPresenterImpl();

        $sut->toJson($outputStub);
        $this->assertInstanceOf(CreateTaskPresenter::class, $sut);
    }
}
