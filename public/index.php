<?php

use PonyForm\Config\Config;
use PonyForm\Controller\HomepageController;
use Slim\Factory\AppFactory;

$BASEDIR = dirname(__DIR__);

require_once $BASEDIR . '/vendor/autoload.php';

$cfg = new Config($BASEDIR);
$app = AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware($cfg->DEBUG, true, true);

$app->get('/', new HomepageController());

$app->run();
