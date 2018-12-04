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

        $apCoords = ApCoordinates::find();
        $apCoords->delete();

        $response = new Response();

        $response->redirect('/')->send();
    }

    public function visualizeAction()
    {
        $this->view->setVars(
            [
                'hostIP' => (string) getHostByName(getHostName())
            ]
        );
    }

    public function storeAccessPointAction()
    {
        $apCoords = ApCoordinates::findFirst();

        $res = $apCoords->save([
            'ap1_x' => $this->request->getPost('ap1x'),
            'ap1_y' => $this->request->getPost('ap1y'),
            'ap2_x' => $this->request->getPost('ap2x'),
            'ap2_y' => $this->request->getPost('ap2y'),
            'ap3_x' => $this->request->getPost('ap3x'),
            'ap3_y' => $this->request->getPost('ap3y'),
        ]);

        if ($res === false)
        {
            foreach ($apCoords->getMessages() as $message) {
                echo $message, "\n";
            }
            die();
        }

        return $this->response->redirect()->send();
    }

    public function storeDevicesAction()
    {
        $requestBody = $this->request->getJsonRawBody();

        $x = (int)$requestBody->x * 5;
        $y = (int)$requestBody->y * 5;
        $name = $requestBody->name;

        $deviceCoord = DeviceCoordinates::findFirst("name = '". $name ."'");
        $status = "CREATED";
        if (! $deviceCoord)
        {
            $deviceCoord = new DeviceCoordinates();

            $deviceCoord->save([
                'x' => $x,
                'y' => $y,
                'name' => $name
            ]);

            $status = "CEK";
        }   
        else{
            $deviceCoord->x = $x;
            $deviceCoord->y = $y;
            $deviceCoord->name = $name;

            $deviceCoord->save();
        }

        $response = new Response();
        $response->setStatusCode(201);
        $response->setContentType("application/json");
        $response->setContent(json_encode(array( "name" => $name )));

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

        $apCoords = ApCoordinates::find();

        $apCoordsResponse = array(
            "ap1x" => (int) $apCoords[0]->ap1_x * 5,
            "ap1y" => (int) $apCoords[0]->ap1_y * 5,
            "ap2x" => (int) $apCoords[0]->ap2_x * 5,
            "ap2y" => (int) $apCoords[0]->ap2_y * 5,
            "ap3x" => (int) $apCoords[0]->ap3_x * 5,
            "ap3y" => (int) $apCoords[0]->ap3_y * 5,
        );

        $responseBody['ap_coords'] = $apCoordsResponse;

        return $responseBody;
    }
}