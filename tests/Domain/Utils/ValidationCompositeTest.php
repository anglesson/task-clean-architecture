<?php

namespace Domain\Utils;

use App\ToDo\Domain\Protocols\AbstractValidator;
use App\ToDo\Domain\Utils\ValidationComposite;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ValidationCompositeTest extends TestCase
{
    private array $sut;

    public function setUp(): void
    {
        $validationMock1 = $this->createMock(AbstractValidator::class);
        $validationMock2 = $this->createMock(AbstractValidator::class);
        $validations = [$validationMock1, $validationMock2];
        $validationComposite = new ValidationComposite($validations);
        $this->sut = [$validationComposite, $validations];
    }

    public function tearDown(): void
    {
        $this->sut = [];
    }

    public function testShouldImplementsValidator()
    {
        [$sut] = $this->sut;
        $this->assertInstanceOf(AbstractValidator::class, $sut);
    }

    public function testShouldReturnErrorIfAnyValidationFails()
    {
        /** @var  MockObject[] $validations */
        [$sut, $validations] = $this->sut;
        $validations[0]->method('validate')->willReturn(new \Error('Validation fails'));
        $error = $sut->validate();
        $this->assertInstanceOf(\Error::class, $error);
    }

    public function testShouldReturnTheFirstErrorIfMoreThanOneValidationFails()
    {
        /** @var  MockObject[] $validations */
        [$sut, $validations] = $this->sut;
        $validations[0]->method('validate')->willReturn(new \CompileError('Validation fails'));
        $validations[1]->method('validate')->willReturn(new \Error('Validation fails'));
        $error = $sut->validate();
        $this->assertInstanceOf(\CompileError::class, $error);
    }
}
