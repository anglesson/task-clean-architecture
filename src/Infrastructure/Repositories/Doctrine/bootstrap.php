<?php
// bootstrap.php
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . "/../../../vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
// or if you prefer YAML or XML
$config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/../config/xml"), $isDevMode);
// $config = ORMSetup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '../../../db.sqlite',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
