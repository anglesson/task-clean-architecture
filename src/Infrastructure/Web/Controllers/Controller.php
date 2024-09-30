<?php

namespace App\ToDo\Infrastructure\Web\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface Controller
{
    public function handle(Request $request, Response $response): Response;
}
