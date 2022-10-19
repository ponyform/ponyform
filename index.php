<?php

use PonyForm\Core\PonyForm;
use PonyForm\SelectionQuestionPlugin\SelectionQuestionPlugin;
use PonyForm\SlimHttpAdapter\SlimHttpAdapter;
use PonyForm\SqliteStorePlugin\SqliteStorePlugin;
use PonyForm\TextQuestionPlugin\TextQuestionPlugin;
use Slim\Factory\AppFactory;

$BASEDIR = dirname(__FILE__);

require_once $BASEDIR . '/vendor/autoload.php';

$ponyForm = new PonyForm(
    baseDir: $BASEDIR,
    storePlugin: new SqliteStorePlugin($BASEDIR . '/db.sqlite3'),
);
$ponyForm->registerPlugin(new TextQuestionPlugin());
$ponyForm->registerPlugin(new SelectionQuestionPlugin());

$app = AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(false, true, true);

(new SlimHttpAdapter($ponyForm))->register($app);

$app->run();
