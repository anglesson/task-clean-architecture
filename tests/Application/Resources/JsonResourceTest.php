<?php

namespace Test\Application\Resources;

use App\ToDo\Application\Resources\JsonResource;
use PHPUnit\Framework\TestCase;

class JsonResourceTest extends TestCase
{
    public function testShouldReturnDataWrappedByIndexCalledData()
    {
        $content = [
            'any_index' => 'any_value',
        ];
        $resource = json_decode(JsonResource::create($content), TRUE);
        $this->assertArrayHasKey( 'data', $resource);
        $this->assertArrayHasKey( 'any_index', $resource['data']);
        $this->assertEquals( 'any_value', $resource['data']['any_index']);
    }
}
