<?php

namespace App\ToDo\Application\Web;

use App\ToDo\Application\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController implements Controller
{
    public function handle(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $view = \file_get_contents(__DIR__.'/../Resources/views/home.html');
        $response->getBody()->write($view);
        return $response->withHeader('Content-type', 'text/html');
    }
}
