<?php

namespace Anglesson\Task\Application\DTO;

use Psr\Http\Message\ServerRequestInterface as Request;

class TaskDTO extends DataTransferObject
{
    public ?string $description;
    public ?bool $finished;

    public static function fromRequest(Request $request)
    {
        $params = $request->getParsedBody();
        return new self([
            'description' => $params['description'] ?? null,
            'finished'    => $params['finished'] ?? null
        ]);
    }
}
