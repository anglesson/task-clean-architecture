<?php
namespace App\ToDo\Infrastructure\Http\Protocols;

interface HttpServer {
    public function registerRoutes(): void;
    public function listen(): void;
}
