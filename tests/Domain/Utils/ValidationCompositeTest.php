<?php

namespace Domain\Utils;

use App\ToDo\Domain\Protocols\Validator;
use App\ToDo\Domain\Utils\ValidationComposite;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ValidationCompositeTest extends TestCase
{
    private array $sut;

    public function setUp(): void
    {
        $validationMock1 = $this->createMock(Validator::class);
        $validationMock2 = $this->createMock(Validator::class);
        $validations= [$validationMock1, $validationMock2];
        $validationComposite = new ValidationComposite($validations);
        $this->sut = [$validationComposite, $validations];
    }

    public function tearDown(): void
    {
        $this->sut = [];
    }

    public function test_should_implements_validator()
    {
        [$sut] = $this->sut;
        $this->assertInstanceOf(Validator::class, $sut);
    }

    public function test_should_return_error_if_any_validation_fails()
    {
        /** @var  MockObject[] $validations */
        [$sut, $validations] = $this->sut;
        $validations[0]->method('validate')->willReturn(new \Error('Validation fails'));
        $error = $sut->validate();
        $this->assertInstanceOf(\Error::class, $error);
    }

    public function test_should_return_the_first_error_if_more_than_one_validation_fails()
    {
        /** @var  MockObject[] $validations */
        [$sut, $validations] = $this->sut;
        $validations[0]->method('validate')->willReturn(new \CompileError('Validation fails'));
        $validations[1]->method('validate')->willReturn(new \Error('Validation fails'));
        $error = $sut->validate();
        $this->assertInstanceOf(\CompileError::class, $error);
    }
}
