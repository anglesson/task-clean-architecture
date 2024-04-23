<?php

require 'vendor/autoload.php';

use App\ToDo\Infrastructure\Utils\Environment;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

Environment::load(__DIR__);
$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders
$isDevMode = true;

$ORMConfig = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/src/Infrastructure/Repositories/Doctrine/mappings"), $isDevMode);

$connection = array(
    'driver' => 'pdo_mysql',
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: '3306',
    'dbname' => getenv('DB_DATABASE') ?: '',
    'user' => getenv('DB_USERNAME') ?: '',
    'password' => getenv('DB_PASSWORD') ?: '',
    'charset' => 'utf8',
);

$entityManager = EntityManager::create($connection, $ORMConfig);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
