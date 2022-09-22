<?php

namespace Anglesson\Task\tests\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\FindTaskService;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use Anglesson\Task\Domain\Services\CreateTaskService;
use Anglesson\Task\Domain\Exceptions\TaskNotFoundException;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository(new RamseyUuid());
        $createTaskService = new CreateTaskService($repository);
        $findTaskService = new FindTaskService($repository);

        $taskCreated = $createTaskService->create(['description' => 'any_description']);
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
