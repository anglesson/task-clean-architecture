<?php

namespace Test\Application\Resources;

use App\ToDo\Application\Resources\JsonResource;
use PHPUnit\Framework\TestCase;

class JsonResourceTest extends TestCase
{
    public function testShouldReturnDataWrappedByIndexCalledData()
    {
        $content = [
            'index' => 'value',
        ];
        $resource = JsonResource::create($content);
        $this->assertIsString($resource);
        $this->assertArrayHasKey( 'data', json_decode($resource, TRUE));
    }
}
