<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class EntityManagerCreator
{
    /**
     * @throws ORMException
     */
    public static function createEntityManager(): EntityManagerInterface
    {
        $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/mappings"));

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '../../../../../db.sqlite',
        );

        return EntityManager::create($conn, $config);
    }
}
