<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateTaskController implements Controller
{
    private CreateTaskUseCase $service;
    private CreateTaskPresenter $presenter;

    public function __construct(CreateTaskUseCase $service, CreateTaskPresenter $presenter)
    {
        $this->service = $service;
        $this->presenter = $presenter;
    }

    public function handle(Request $request, Response $response): Response
    {
        
        $data = $request->getParsedBody();
        if (!$data) {
            throw new MissingParamsError();
        }
        $inputCreateTask = InputCreateTask::create($data);
        $outputCreateTask = $this->service->execute($inputCreateTask);

        $response->getBody()->write((string) $this->presenter->toJson($outputCreateTask));
        return $response;
    }
}
