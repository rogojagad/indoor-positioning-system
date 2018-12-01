<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;

class CoordinatesController extends BaseController
{
    public function showAction()
    {
        $this->view->disable();

        $responseBody = $this->buildResponseBody();
     
        $response = new Response();

        $response->setStatusCode(200, "OK");
        $response->setContentType("application/json");
        $response->setContent(json_encode($responseBody));

        return $response;
    }

    public function destroyAction()
    {
        $devicesCoords = DeviceCoordinates::find();
        $devicesCoords->delete();
    }

    public function visualizeAction()
    {

    }

    public function storeDevicesAction()
    {
        $requestBody = $this->request->getJsonRawBody();

        $x = (int)$requestBody->x;
        $y = (int)$requestBody->y;
        $name = $requestBody->name;

        $deviceCoord = DeviceCoordinates::findFirst("name = '". $name ."'");

        if (! $deviceCoord)
        {
            $deviceCoord = new DeviceCoordinates();

            $deviceCoord->save([
                'x' => $x,
                'y' => $y,
                'name' => $name
            ]);
        }   
        else{
            $deviceCoord->x = $x;
            $deviceCoord->y = $y;
            $deviceCoord->name = $name;

            $deviceCoord->save();
        }

        $response = new Response();
        $response->setStatusCode(201, "CREATED");

        return $response;
    }

    private function buildResponseBody()
    {
        $devicesCoords = DeviceCoordinates::find();

        $responseBody = [];

        $deviceCoordResponse = [];

        foreach ($devicesCoords as $coord) {
            array_push($deviceCoordResponse, $coord);
        }

        $responseBody['devices_coords'] = $deviceCoordResponse;

        return $responseBody;
    }
}