<?php

/**
 * Description of HomeController
 * Default controller, redirect to login
 * @author gino
 */
class Home extends Controller 
{
    public function index() 
    {
        $loginService = $this->loginService;
        $redirect = 'Location: ' . $loginService::ERROR_REDIRECT;        
        header($redirect);
        die();
    }
}
