<?php

namespace Test\Domain\Services;

use PHPUnit\Framework\TestCase;
use App\ToDo\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use App\ToDo\Domain\Services\CreateTaskServiceImpl;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository();
        $createTaskService = new CreateTaskServiceImpl($repository, new RamseyUuidImpl());
        $findTaskService = new FindTaskServiceImpl($repository);

        $requestStub = $this->createStub(ServerRequestInterface::class);
        
        $requestStub->method('getParsedBody')->willReturn(['description' => 'any_description_1']);
        $taskDTO = TaskDTO::fromRequest($requestStub);

        $taskCreated = $createTaskService->create($taskDTO);
        $taskFinded = $findTaskService->find($taskCreated->getId());

        $this->assertEquals($taskFinded, $taskCreated);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new MockRepository();
        $findTaskService = new FindTaskServiceImpl($repository);

        $findTaskService->find('any_id');
    }
}
