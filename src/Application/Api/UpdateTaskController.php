<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Application\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\UpdateTask\IUpdateTaskUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateTaskController implements Controller
{
    private IUpdateTaskUseCase $service;

    public function __construct(IUpdateTaskUseCase $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Response $response): Response
    {
        if (!$request->getParsedBody()) {
            throw new MissingParamsError();
        }
        $inputUpdateTask = InputUpdateTask::create($request->getParsedBody());
        $inputUpdateTask->id = $request->getAttribute('id');
        $outputUpdateTask = $this->service->execute($inputUpdateTask);
        $response->getBody()->write($outputUpdateTask->toJson());
        return $response;
    }
}
