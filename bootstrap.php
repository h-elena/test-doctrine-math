<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'dbname' => 'test1_cms',
    'user' => 'root',
    'password' => ''
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);