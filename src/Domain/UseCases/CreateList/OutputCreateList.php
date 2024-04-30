<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Application\DTO\DataTransferObject;
use App\ToDo\Core\Collection;

class OutputCreateList extends DataTransferObject
{
    public Collection $lists;
}