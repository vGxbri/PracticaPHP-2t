<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once "vendor/autoload.php";

$entityManager = require_once "doctrine-config.php";

return ConsoleRunner::createHelperSet($entityManager);