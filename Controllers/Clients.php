<?php
/**
 * Description of Login Controller
 * @author Gino
 */

class Clients extends Controller 
{
    protected $clientService = null;
    protected $addClientErrorMessageKey = 'ADD_CLIENT_ERROR';
    protected $editClientErrorMessageKey = 'EDIT_CLIENT_ERROR';

    public function __construct()
    {
        parent::__construct();
        $this->clientService  = new ClientService();
        $this->checkIfUserIsLogedIn();
    }

    public function edit($clientId = null)
    {
        if (!empty($clientId) && is_numeric($clientId)) {
            $clientService = $this->clientService;
            $client = $clientService->getClientById($clientId);
            if (!$client) {
                header('Location: /clients');
                die(); 
            }
            $this->view->error = $this->getEditErrorMessage();
            $this->view->data['cities'] = $clientService->getAllCities();            
            $this->view->data['client'] = $client;
            $this->view->title = 'TiendaGino - Edit Client';
            $this->view->render('client-edit');
        } else {
            header('Location: /clients');
            die();            
        }
    }

    public function update()
    {
        $clientId = $_POST['client_id'] ?? null;
        $cityId = $_POST['city_id'] ?? null;
        $name = $_POST['name'] ?? null;
        $code = $_POST['code'] ?? null;
        $image = $_POST['client_image_name'] ?? null;
        if (!$cityId || !$name || !$code) {
            $_SESSION[$this->editClientErrorMessageKey] = 'Please complete all fields';
            $location = "Location: /clients/$clientId/edit";
            header($location);
            die();
        }
        $clientService = $this->clientService;
        $deleteClientImage = !empty($_POST['delete_image_input']) && $_POST['delete_image_input'] === 'yes';
        if (($deleteClientImage || !empty($_FILES["client-image"]["name"])) && $clientService->deleteClientImage($clientId)) {
            $image = null;
        }
        $imageUploaded = $clientService->uploadPicture($clientId);
        if ($imageUploaded) {
            $image = $imageUploaded;
        }
        $clientService->updateClient($clientId, $cityId, $name, $code, $image);

        header('Location: /clients');
        die(); 
    }

    public function index() 
    {
        $page = $_GET['page'] ?? 1;
        $clientService = $this->clientService;
        $this->view->data['clients'] = $clientService->getAll($page);
        $this->view->data['pages'] = $clientService->calculatePages();
        $this->view->data['page'] = $page;
        $this->view->title = 'TiendaGino - Clients';
        $this->view->render('clients');
    }

    public function create()
    {
        $clientService = $this->clientService;
        $this->view->data = $clientService->getAllCities();
        $this->view->title = 'TiendaGino - Create Client';
        $this->view->error = $this->getErrorMessage();
        $this->view->render('client-create');
    }

    public function add()
    {
        $cityId = $_POST['city_id'] ?? null;
        $name = $_POST['name'] ?? null;
        $code = $_POST['code'] ?? null;
        if (!$cityId || !$name || !$code) {
            $_SESSION[$this->addClientErrorMessageKey] = 'Please complete all fields';
            header('Location: /clients/create');
            die();
        }
        $clientService = $this->clientService;
        $lastIdInserted = $clientService->createClient($cityId, $name, $code);
        if (!$lastIdInserted) {
            $_SESSION[$this->addClientErrorMessageKey] = 'Database error creating client';
            header('Location: /clients/create');
            die();            
        }
        $pictureUploaded = $clientService->uploadPicture($lastIdInserted);
        if ($pictureUploaded) {
            $updateClient = $clientService->updateClient($lastIdInserted, $cityId, $name, $code, $pictureUploaded);
            if (!$updateClient) {
                $_SESSION[$this->addClientErrorMessageKey] = 'Database error updating client picture';
                header('Location: /clients/create');
                die();            
            }            
        }

        header('Location: /clients');
        die();         
    } 
    
    protected function getErrorMessage(): ?string 
    {
        $errorMessage = !empty($_SESSION[$this->addClientErrorMessageKey]) ? $_SESSION[$this->addClientErrorMessageKey] : null;
        unset($_SESSION[$this->addClientErrorMessageKey]);

        return $errorMessage;
    }

    protected function getEditErrorMessage(): ?string 
    {
        $errorMessage = !empty($_SESSION[$this->editClientErrorMessageKey]) ? $_SESSION[$this->editClientErrorMessageKey] : null;
        unset($_SESSION[$this->editClientErrorMessageKey]);

        return $errorMessage;
    }    
   
}
