<?php
/**
 * Description of Login Controller
 * @author Gino
 */

class Login extends Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->checkIfUserIsAlreadyLogedIn();
        $loginService = $this->loginService;
        $authError = !empty($_SESSION[$loginService::AUTH_ERROR_SESSION_KEY]);
        $this->view->title = 'TiendaGino - Login';
        $this->view->error = $authError ? 'Invalid username / password' : false;
        $this->view->render('login');
    }

    public function check() 
    {
        $loginService = $this->loginService;
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null; 
        $authenticated = $loginService->loginUser($userName, $password);
        $redirect = 'Location: ' . ($authenticated ? $loginService::SUCCESS_REDIRECT : $loginService::ERROR_REDIRECT);
        
        header($redirect);
    } 

    public function exit()
    {
        $loginService = $this->loginService;
        session_destroy();
        $redirect = 'Location: ' . $loginService::ERROR_REDIRECT;
        
        header($redirect);        
    }

    protected function checkIfUserIsAlreadyLogedIn(): void
    {
        $loginService = $this->loginService;
        if ($loginService->isUserLogedIn()) {
            $redirect = 'Location: ' . $loginService::SUCCESS_REDIRECT;
            header($redirect);
            die();
        }           
    }
    
}
