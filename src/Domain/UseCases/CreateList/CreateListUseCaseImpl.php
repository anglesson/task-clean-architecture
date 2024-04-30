<?php
namespace App\ToDo\Domain\UseCases\CreateList;

class CreateListUseCaseImpl implements CreateListUseCase
{
    public function __construct()
    {

    }

    public function execute(): OutputCreateList
    {
        return new OutputCreateList();
    }
}
