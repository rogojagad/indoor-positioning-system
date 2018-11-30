<?php

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller
{
    protected function _middleware($calledAction, $restrictedActions)
    {
        // Act as middleware to check whether the user is already log in or not
        // Can be overridden as needed

        if(in_array($calledAction, $restrictedActions))
        {
            if(! $this->session->has('auth'))
            {
                $this->flashSession->warning("Anda harus login terlebih dahulu");
                
                $this->response->redirect('login')->send();
            }
        }
    }
}