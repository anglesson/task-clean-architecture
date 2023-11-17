<?php

namespace Test\Infrastructure\Utils;

use App\ToDo\Infrastructure\Utils\SymfonyUidImpl;
use PHPUnit\Framework\TestCase;

class SymfonyUidImplTest extends TestCase
{
    public function testShouldReturnAString()
    {
        $uuid = new SymfonyUidImpl();
        $this->assertIsString($uuid->generateId());
    }
}
