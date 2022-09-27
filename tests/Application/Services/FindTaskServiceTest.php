<?php

namespace Test\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\FindTaskService;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use Anglesson\Task\Domain\Services\CreateTaskService;
use Anglesson\Task\Domain\Exceptions\TaskNotFoundException;
use Anglesson\Task\Application\DTO\TaskDTO;
use Psr\Http\Message\ServerRequestInterface;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository(new RamseyUuid());
        $createTaskService = new CreateTaskService($repository);
        $findTaskService = new FindTaskService($repository);

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
        $repository = new MockRepository(new RamseyUuid());
        $findTaskService = new FindTaskService($repository);

        $findTaskService->find('any_id');
    }
}
