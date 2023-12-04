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
        $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__ . "/mappings"));

        $conn = array(
            'driver'   => 'pdo_mysql',
            'host'     => getenv('DB_HOST') ?: 'localhost',
            'port'     => getenv('DB_PORT') ?: '3306',
            'dbname'   => getenv('DB_DATABASE') ?: '',
            'user'     => getenv('DB_USERNAME') ?: '',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset'  => 'utf8',
        );

        return EntityManager::create($conn, $config);
    }
}
