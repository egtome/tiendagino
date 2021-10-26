<?php
/**
 * Description of Controller
 * Controller core
 * @author gino
 */
if (defined('SITE_LOADED') === false) {
    //exit('DENIED');
    header('HTTP/1.0 403 Forbidden');
    die();
}

class Controller {
    protected $view = null;
    protected $loginService = null;
    
    public function __construct() {
        $this->loginService  = new LoginService();
        $this->view = new View();
    }

    public function checkIfUserIsLogedIn(): void
    {
        $loginService = $this->loginService;
        if (!$loginService->isUserLogedIn()) {
            $redirect = 'Location: ' . $loginService::ERROR_REDIRECT;
            header($redirect);
            die();
        }
    }
}
