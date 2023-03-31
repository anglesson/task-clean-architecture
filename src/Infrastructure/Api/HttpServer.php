<?php
namespace App\ToDo\Infrastructure\Api;

use App\ToDo\Application\Protocols\Http\Controller;

interface HttpServer {
    public function register(string $method, string $url, Controller $controller): void;
    public function listen(): void;
}