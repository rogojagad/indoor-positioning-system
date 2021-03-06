<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class CoordinatesRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths(
            [
                'controller' => 'coordinates',
            ]
        );
        
        $this->addGet(
            '/coordinates',
            [
                'action' => 'show',
            ]
        );

        $this->addGet(
            '/visualization',
            [
                'action' => 'visualize',
            ]
        );

        $this->addPost(
            '/devices-coordinates',
            [
                'action' => 'storeDevices',
            ]
        );

        $this->addPost(
            '/ap-coordinates',
            [
                'action' => 'storeAccessPoint',
            ]
        );

        $this->addPost(
            '/delete/coordinates',
            [
                'action' => 'destroy',
            ]
        );
    }
}

