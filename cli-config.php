<?php

require_once 'vendor/autoload.php';

use Anglesson\Task\Infrastructure\Repositories\Doctrine\EntityManagerCreator;

$entityManager = (new EntityManagerCreator())->createEntityManager();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
