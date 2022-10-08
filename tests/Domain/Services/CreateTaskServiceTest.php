<?php

namespace Test\Domain\Services;

use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Application\DTO\TaskDTO;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Protocols\CreateTaskService;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;

class CreateTaskServiceTest extends TestCase
{
    private function makeFakeTask(): Task
    {
        $task = new Task();
        $task->description = 'Any Task';
        $task->finished = false;
        return $task;
    }

    private function makeCreateService(): CreateTaskService
    {
        $mockUuid = new RamseyUuidImpl();
        $mockRepository = new MockRepository();
        return new CreateTaskServiceImpl($mockRepository, $mockUuid);
    }

    public function testShouldBeCreatedATask()
    {
        $requestStub = $this->createMock(ServerRequestInterface::class);
        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        $taskCriada = ($this->makeCreateService())->create($taskDTO);
        $this->assertEquals('any_description', $taskCriada->getDescription());
    }

    public function testShouldBeThrowsIfMissingParams()
    {
        $requestStub = $this->createMock(ServerRequestInterface::class);
        $requestStub->method('getParsedBody')->willReturn(['any_field' => 'any_description']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        
        $this->expectException(MissingParamsError::class);
        ($this->makeCreateService())->create($taskDTO);
    }
}
