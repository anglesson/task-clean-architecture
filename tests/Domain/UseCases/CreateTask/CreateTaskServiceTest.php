<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskServiceImpl;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase
{
    private function makeCreateService(): CreateTaskService
    {
        $mockUuid = new RamseyUuidImpl();
        $mockRepository = new MockRepository();
        return new CreateTaskServiceImpl($mockRepository, $mockUuid);
    }

    public function testShouldBeCreatedATask()
    {
        $inputCreateTask = new InputCreateTask(['description' => 'any_description']);
        $taskCriada = ($this->makeCreateService())->create($inputCreateTask);
        $this->assertEquals('any_description', $taskCriada->getDescription());
    }

    public function testShouldBeThrowsIfMissingParams()
    {
        $inputCreateTask = new InputCreateTask([]);
        $this->expectException(MissingParamsError::class);
        ($this->makeCreateService())->create($inputCreateTask);
    }
}
