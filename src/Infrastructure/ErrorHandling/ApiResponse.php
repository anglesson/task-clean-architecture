<?php

namespace App\ToDo\Infrastructure\ErrorHandling;

class ApiResponse
{
    private $statusCode;
    private $message;

    private $trace;

    public function __construct(int $statusCode, string $message, string|array $trace = "")
    {
        $this->statusCode = $statusCode;
        $this->message    = $message;
        $this->trace = $trace;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'code'    => $this->statusCode,
            'message' => $this->message,
            'trace' => $this->trace,
        ]);
    }
}
