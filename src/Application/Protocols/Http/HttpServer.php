<?php
namespace App\ToDo\Application\Protocols\Http;

interface HttpServer {
    public function register(string $method, string $url, Controller $controller, $middlewares = []): void;
    public function applyMiddlewares(array $middlewares): void;
    public function listen(): void;
}