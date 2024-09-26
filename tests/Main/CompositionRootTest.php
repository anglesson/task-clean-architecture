<?php

use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Infrastructure\ErrorHandling\ErrorHandlerInterface;
use App\ToDo\Infrastructure\Http\Protocols\HttpServer;
use App\ToDo\Infrastructure\Utils\LoadEnvInterface;
use App\ToDo\Main\CompositionRoot;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CompositionRootTest extends TestCase
{
    public function testCreateTaskRepository(): void
    {
        $taskRepository = CompositionRoot::createTaskRepository();
        $this->assertInstanceOf(TaskRepository::class, $taskRepository);
    }

    public function testCreateTaskListRepository(): void
    {
        $taskListRepository = CompositionRoot::createTaskListRepository();
        $this->assertInstanceOf(TaskListRepository::class, $taskListRepository);
    }

    public function testCreateServer(): void
    {
        $server = CompositionRoot::createServer();
        $this->assertInstanceOf(HttpServer::class, $server);
    }

    public function testCreateLoadEnv(): void
    {
        $loadEnv = CompositionRoot::createLoadEnv();
        $this->assertInstanceOf(LoadEnvInterface::class, $loadEnv);
    }

    public function testCreateLogger(): void
    {
        $logger = CompositionRoot::createLogger();
        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    public function testCreateErrorHandler(): void
    {
        $errorHandler = CompositionRoot::createErrorHandler();
        $this->assertInstanceOf(ErrorHandlerInterface::class, $errorHandler);
    }
}