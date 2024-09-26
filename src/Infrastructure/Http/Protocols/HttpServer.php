<?php

namespace App\ToDo\Infrastructure\Http\Protocols;

interface HttpServer
{
    public function listen(): void;
}
