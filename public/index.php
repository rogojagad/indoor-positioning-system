<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Db\Adapter\Pdo\Mysql as DBAdapter;

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '\app');
// ...

require __DIR__ . '/../vendor/autoload.php';

require_once APP_PATH. '/Bootstrap.php';

$app = new Bootstrap();

$app->init();