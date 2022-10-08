<?php

namespace Test\Domain\Services;

use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Application\DTO\TaskDTO;
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
        $mockRepository = new MockRepository($mockUuid);
        return new CreateTaskServiceImpl($mockRepository);
    }

    public function testShouldBeCreatedATask()
    {
        $requestStub = $this->createMock(ServerRequestInterface::class);
        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description']);
        $taskDTO = TaskDTO::fromRequest($requestStub);
        $taskCriada = ($this->makeCreateService())->create($taskDTO);
        $this->assertEquals('any_description', $taskCriada->getDescription());
    }
}
