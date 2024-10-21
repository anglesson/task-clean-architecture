<?php

namespace Test\Infrastructure\ErrorHandling;

use App\ToDo\Infrastructure\ErrorHandling\ErrorHandler;
use App\ToDo\Infrastructure\ErrorHandling\ErrorHandlerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ErrorHandlerTest extends TestCase
{
    public function testShouldReturnsAErrorHandler()
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->assertInstanceOf(ErrorHandlerInterface::class, new ErrorHandler($logger));
    }

    public function testShouldHandleError()
    {
        $logger       = $this->createMock(LoggerInterface::class);
        $errorHandler = new ErrorHandler($logger);
        $errorHandler->register();
        $errorHandler->handleError(E_ERROR, 'Error message', 'file.php', 10);
        $this->expectOutputString('{"code":500,"message":"Erro fatal. Execu\u00e7\u00e3o interrompida.","trace":""}');
    }

    public function testShouldHandleException()
    {
        $exception    = new \Exception('Exception message', 400);
        $logger       = $this->createMock(LoggerInterface::class);
        $errorHandler = new ErrorHandler($logger);
        $errorHandler->register();
        $errorHandler->handleException($exception);

        $traceAsJson = json_encode($exception->getTrace());

        $this->expectOutputString('{"code":400,"message":"Exception message","trace":' . $traceAsJson . '}');
    }
}
