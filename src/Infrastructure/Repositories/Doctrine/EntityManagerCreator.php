<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class EntityManagerCreator
{
    public function createEntityManager(): EntityManagerInterface
    {
        $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"));

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '../../../db.sqlite',
        );

        return EntityManager::create($conn, $config);
    }
}
