<?php
namespace Test\Domain\UseCases\CreateList;

use App\ToDo\Domain\UseCases\CreateList\CreateListUseCase;
use App\ToDo\Domain\UseCases\CreateList\CreateListUseCaseImpl;
use App\ToDo\Domain\UseCases\CreateList\OutputCreateList;
use PHPUnit\Framework\TestCase;

class CreateListTest extends TestCase
{
    public function testShouldCreateANewList()
    {
        $createList = new CreateListUseCaseImpl();
        $outputList = $createList->execute();
        $this->assertInstanceOf(OutputCreateList::class, $outputList);
        $this->assertInstanceOf(CreateListUseCase::class, $createList);
    }
}