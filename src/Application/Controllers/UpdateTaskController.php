<?php

namespace App\ToDo\Application\Controllers;

use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenter;
use App\ToDo\Application\Controllers\Controller;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateTaskController implements Controller
{
    private UpdateTaskUseCase $service;
    private UpdateTaskPresenter $presenter;

    public function __construct(UpdateTaskUseCase $service, UpdateTaskPresenter $presenter)
    {
        $this->service = $service;
        $this->presenter = $presenter;
    }

    public function handle(Request $request, Response $response): Response
    {
        if (!$request->getParsedBody()) {
            throw new MissingParamsError();
        }
        $inputUpdateTask = InputUpdateTask::create($request->getParsedBody());
        $inputUpdateTask->id = $request->getAttribute('id');
        $outputUpdateTask = $this->service->execute($inputUpdateTask);
        $response->getBody()->write((string) $this->presenter->toJson($outputUpdateTask));

        return $response;
    }
}
