<?php

use Dotenv\Dotenv;
use PonyForm\Core\PonyForm;
use PonyForm\SelectionFieldPlugin\SelectionFieldPlugin;
use PonyForm\SlimHttpAdapter\SlimHttpAdapter;
use PonyForm\SqliteStorePlugin\SqliteStorePlugin;
use PonyForm\TextFieldPlugin\TextFieldPlugin;
use PonyForm\Website\Http\SlimHttpAdapter as WebsiteSlimHttpAdapter;
use Slim\Factory\AppFactory;

$BASEDIR = dirname(__DIR__);

require_once $BASEDIR . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable($BASEDIR);
$dotenv->safeLoad();
$DEBUG = !empty($_ENV['DEBUG']);

$ponyForm = new PonyForm(
    baseDir: $BASEDIR,
    storePlugin: new SqliteStorePlugin($BASEDIR . '/database/db.sqlite3'),
    options: [
        "debug" => $DEBUG,
        "pathname" => '/f',
    ],
);
$ponyForm->registerPlugin(new TextFieldPlugin());
$ponyForm->registerPlugin(new SelectionFieldPlugin());

$app = AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware($DEBUG, true, true);

(new SlimHttpAdapter($ponyForm))->register($app);
(new WebsiteSlimHttpAdapter())->register($app);

$app->run();
