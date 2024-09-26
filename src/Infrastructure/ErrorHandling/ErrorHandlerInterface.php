<?php

namespace App\ToDo\Infrastructure\ErrorHandling;

interface ErrorHandlerInterface
{
    public function register(): void;
}
