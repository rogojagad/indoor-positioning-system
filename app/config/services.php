<?php
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Events\Event as Event;
use Phalcon\Mvc\Dispatcher\Exception as Exception;

$di->set(
    'voltService',
    function ($view, $di) {
        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions([
            "compiledPath"      => APP_PATH . "/cache/",
            "compiledExtension" => ".compiled",
            "compileAlways"     => true,
        ]);

        return $volt;
    }
);

$di->set(
    'view',
    function () {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir(APP_PATH . "/views");
        // echo APP_PATH."\\views";

        $view->registerEngines([
            ".volt" => "voltService",
        ]);

        return $view;
    }
);

$di->set(
    'url',
    function () use ($config, $di) {
        $url = new \Phalcon\Mvc\Url();

        $url->setBaseUri($config->path('url.baseUrl'));

        return $url;
    }
);

$di->set(
    'db',
    function () use ($config) {
        $dbAdapter = $config->database->adapter;
        
        return new $dbAdapter([
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname,
            "options" => [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC],
        ]);
    }
);

$di->set(
    'dispatcher',
    function () use ($di){
        $eventsManager = $di->getShared('eventsManager');

        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);