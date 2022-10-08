<?php

require_once 'vendor/autoload.php';

use App\ToDo\Infrastructure\Repositories\Doctrine\EntityManagerCreator;

$entityManager = (new EntityManagerCreator())->createEntityManager();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
