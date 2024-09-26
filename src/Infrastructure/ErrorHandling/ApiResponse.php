<?php

namespace App\ToDo\Infrastructure\ErrorHandling;

class ApiResponse
{
    private $statusCode;
    private $message;

    public function __construct(int $statusCode, string $message)
    {
        $this->statusCode = $statusCode;
        $this->message    = $message;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'code'    => $this->statusCode,
            'message' => $this->message,
        ]);
    }
}
