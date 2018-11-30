<?php

$di->set(
    'router',
    function () {
        $router = new \Phalcon\Mvc\Router(false);

        $router->mount(
            new CoordinatesRoutes()
        );

        $router->addGet(
            '/',
            [
                'controller' => 'index',
                'action'     => 'index',
            ]
        );

        $router->notFound([
            'controller' => 'index',
            'action'     => 'show404',
            'params'    =>  "Sorry, this URL doesn't exist",
        ]);

        $router->removeExtraSlashes(true);

        return $router;
    }
);

