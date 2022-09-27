<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\FindTaskServiceImpl;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuidImpl;
use Anglesson\Task\Domain\Services\CreateTaskServiceImpl;
use Anglesson\Task\Domain\Exceptions\TaskNotFoundException;
use Anglesson\Task\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository(new RamseyUuidImpl());
        $createTaskService = new CreateTaskServiceImpl($repository);
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
        $repository = new MockRepository(new RamseyUuidImpl());
        $findTaskService = new FindTaskServiceImpl($repository);

        $findTaskService->find('any_id');
    }
}
