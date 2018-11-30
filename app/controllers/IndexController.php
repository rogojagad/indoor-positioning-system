<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->response->redirect('visualization');
    }

    public function show404Action($message)
    {
        $this->view->setVars([
            'message' => $message,
        ]);
    }
}