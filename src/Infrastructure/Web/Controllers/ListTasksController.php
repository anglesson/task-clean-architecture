<?php

namespace App\ToDo\Infrastructure\Web\Controllers;

use App\ToDo\Application\Presenters\ListTask\ListTaskPresenter;
use App\ToDo\Infrastructure\Web\Controllers\Controller;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListTasksController implements Controller
{
    private readonly ListTasksUseCase $useCase;
    private readonly ListTaskPresenter $presenter;

    public function __construct(ListTasksUseCase $useCase, ListTaskPresenter $presenter)
    {
        $this->useCase = $useCase;
        $this->presenter = $presenter;
    }

    public function handle(Request $request, Response $response): Response
    {
        $output = $this->useCase->execute();
        $response->getBody()->write((string) $this->presenter->toJson($output));
        return $response;
    }
}
