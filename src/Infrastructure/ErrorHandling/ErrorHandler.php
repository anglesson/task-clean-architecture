<?php

namespace App\ToDo\Infrastructure\ErrorHandling;

use Psr\Log\LoggerInterface;

class ErrorHandler implements ErrorHandlerInterface
{
    private static LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    public function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleException(\Throwable $exception)
    {
        self::$logger->error($exception->getMessage(), ['exception' => $exception->getTraceAsString()]);

        $response = new ApiResponse($exception->getCode(), $exception->getMessage(), $exception->getTrace());
        $response->send();
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        self::$logger->error("Erro: [$errno] $errstr - $errfile:$errline");

        if ($errno === E_ERROR) {
            $response = new ApiResponse(500, 'Erro fatal. Execução interrompida.');
            $response->send();
        }
    }

    public static function handleShutdown()
    {
        $error = error_get_last();

        if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
            self::$logger->error("Erro fatal: {$error['message']} em {$error['file']} na linha {$error['line']}");

            $response = new ApiResponse(500, 'Erro fatal no servidor.');
            $response->send();
        }
    }
}
