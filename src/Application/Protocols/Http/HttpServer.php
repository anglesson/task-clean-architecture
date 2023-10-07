<?php
namespace App\ToDo\Application\Protocols\Http;

interface HttpServer {
    public function register(string $method, string $url, Controller $controller): void;
    public function listen(): void;
}