<?php

namespace Test\Application;

use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Application\Presenters\CreateTask\ICreateTaskPresenter;
use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;
use PHPUnit\Framework\TestCase;

class CreateTaskPresenterTest extends TestCase
{
    public function testShouldImplementsACreateTaskPresenterInterface()
    {
        $outputStub = $this->createStub(OutputCreateTask::class);

        $sut = new CreateTaskPresenter();

        $sut->toJson($outputStub);
        $this->assertInstanceOf(ICreateTaskPresenter::class, $sut);
    }
}
