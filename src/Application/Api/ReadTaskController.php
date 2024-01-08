<?php

namespace App\ToDo\Application\Api;

use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenter;
use App\ToDo\Application\Protocols\Http\Controller;
use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReadTaskController implements Controller
{
    public function __construct(
        private readonly ReadTaskUseCase $service,
        private readonly ReadTaskPresenter $presenter
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        // TODO: Move to a Request Middleware or Create a Validation
        if (!$id) {
            throw new MissingParamsError('id');
        }

        $output = $this->service->execute($id);
        $response->getBody()->write((string) $this->presenter->toJson($output));
        return $response->withHeader('Content-type', 'application/json');
    }
}
