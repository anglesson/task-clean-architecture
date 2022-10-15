<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListaAllTaskController implements Controller
{

    public function handle(Request $request, Response $response): Response
    {
        return $response;
    }
}
