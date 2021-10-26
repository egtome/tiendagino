<?php

class ClientService
{
    public const DEFAULT_PAGE_SIZE = 3;
    public const IMAGE_PATH = 'assets/user-images/';
    public function getAll(int $page): array
    {
        $clientModel = new ClientModel();
        $offset = $this->calculateOffset($page);

        return $clientModel->getAll($offset, self::DEFAULT_PAGE_SIZE);
    }

    protected function calculateOffset(int $page): int
    {
        return ($page * self::DEFAULT_PAGE_SIZE) - self::DEFAULT_PAGE_SIZE;
    }

    public function calculatePages(): int
    {
        $clientModel = new ClientModel();
        $total = $clientModel->countClients();
        $totalClients = $total[0]['total_clients'] ?? 0;
        if ($totalClients === 0) {
            return 1;
        } else {
            return ceil($totalClients / self::DEFAULT_PAGE_SIZE);
        }
    }    

    public function getAllCities(): ?array
    {
        $cityModel = new CityModel();

        return $cityModel->getAll();
    }

    public function createClient(int $cityId, string $name, string $code):? int
    {
        $clientModel = new ClientModel();
        $clientModel->setCityId($cityId);
        $clientModel->setName($name);
        $clientModel->setCode($code);

        return $clientModel->createClient();
    }

    public function uploadPicture(int $clientId)
    {
        if (!empty($_FILES['client-image']['tmp_name'])) {
            $newName = $clientId . '-' . basename($_FILES["client-image"]["name"]);
            $targetFile = self::IMAGE_PATH . $newName;
            if (move_uploaded_file($_FILES["client-image"]["tmp_name"], $targetFile)) {
                return $newName;
            } else{
                return false;
            }
        }       
        
        return false;
    }

    public function deleteClientImage(int $clientId): bool
    {
        $client = $this->getClientById($clientId);
        if (!empty($client['picture'])) {
            $image = $_SERVER['DOCUMENT_ROOT'] . '/' . self::IMAGE_PATH . $client['picture'];
            if (file_exists($image) && unlink($image)) {
                return true;
            }
        }

        return false;
    }

    public function updateClient(int $id, int $cityId, string $name, string $code, ?string $picture): bool
    {
        $clientModel = new ClientModel();
        $clientModel->setId($id);
        $clientModel->setCityId($cityId);
        $clientModel->setName($name);
        $clientModel->setCode($code);
        $clientModel->setPicture($picture);

        return $clientModel->updateClient();
    } 

    public function getClientById(int $clientId): array
    {
        $clientModel = new ClientModel();
        $clientModel->setId($clientId); 
        $client = $clientModel->getCLientById();

        return $client[0] ?? [];
    }

    public function getCitiesListHtmlAjax($defaultCity = null): string
    {
        $cities = $this->getAllCities();
        $html = '<option value="">Select city...</option>';
        foreach ($cities as $city) {
            $cityId = $city['id'];
            $cityName = $city['name'];
            $selected = $cityId == $defaultCity ? 'selected' : '';
            $html .= '<option value="' . $cityId . '" ' . $selected . '>' . $cityName . '</option>' ;  
        }

        return $html;
    }

}