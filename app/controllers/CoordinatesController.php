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

    public function storeAPAction()
    {
        $requestBody = $this->request->getJsonRawBody();

        $apCoords = new ApCoordinates();

        $res = $apCoords->save([
            'ap1_x' => (int)$requestBody->ap1->x,
            'ap1_y' => (int)$requestBody->ap1->y,
            'ap2_x' => (int)$requestBody->ap2->x,
            'ap2_y' => (int)$requestBody->ap2->y,
            'ap3_x' => (int)$requestBody->ap3->x,
            'ap3_y' => (int)$requestBody->ap3->y,
        ]);

        $response = new Response();
        $response->setStatusCode(201, "CREATED");

        return $response;
    }

    private function buildResponseBody()
    {
        $apCoords = ApCoordinates::find()->getLast();
        $devicesCoords = DeviceCoordinates::find();

        $responseBody = [
            'access_points_coords' => [
                [
                    'x' => $apCoords->ap1_x,
                    'y' => $apCoords->ap1_y
                ],
                [
                    'x' => $apCoords->ap2_x,
                    'y' => $apCoords->ap2_y
                ],
                [
                    'x' => $apCoords->ap3_x,
                    'y' => $apCoords->ap3_y
                ],
            ],
        ];

        $deviceCoordResponse = [];

        foreach ($devicesCoords as $coord) {
            array_push($deviceCoordResponse, $coord);
        }

        $responseBody['devices_coords'] = $deviceCoordResponse;

        return $responseBody;
    }
}