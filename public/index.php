<?php

use PonyForm\Controller\HomepageController;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', new HomepageController());

$app->run();
