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
        $resource = json_decode(new JsonResource($content), TRUE);
        $this->assertArrayHasKey( 'any_index', $resource);
        $this->assertEquals( 'any_value', $resource['any_index']);
    }
}
