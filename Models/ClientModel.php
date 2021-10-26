<?php
/**
 * Description of Client Model
 *
 * @author gino
 */
class ClientModel extends Model { 
    private $tableName = 'clients';   
    public $id = null;
    public $cityId = null;
    public $name = null;
    public $code = null;
    public $picture = null;

    function getCityId(): int 
    {
        return $this->cityId;
    }

    function getName(): string 
    {
        return $this->name;
    } 
    
    function getCode(): string 
    {
        return $this->code;
    } 
    
    function getPicture(): ?string 
    {
        return $this->picture;
    } 

    function getId(): ?int 
    {
        return $this->id;
    } 

    function setId(int $id): void 
    {
        $this->id = $id;
    }   
    
    function setCityId(int $cityId): void 
    {
        $this->cityId = $cityId;
    }

    function setName(string $name): void 
    {
        $this->name = $name;
    }    

    function setCode(string $code): void 
    {
        $this->code = $code;
    }  
    
    function setPicture(?string $picture): void 
    {
        $this->picture = $picture;
    }      
    
    public function getAll(int $offset, int $perPage): ?array
    {
        $sql = "SELECT cl.*, ci.name as city_name from {$this->tableName} cl left join cities ci on cl.city_id = ci.id ORDER BY ID desc LIMIT {$offset}, {$perPage};";

        return $this->getQuery($sql);        
    }

    public function countClients(): ?array
    {
        $sql = "SELECT COUNT(id) AS `total_clients` FROM {$this->tableName};";

        return $this->getQuery($sql);        
    }    

    public function createClient():? int
    {
        $cityId = $this->getCityId();
        $name = $this->getName();
        $code = $this->getCode();
        $sql = "INSERT INTO {$this->tableName} (city_id, name, code) VALUES ($cityId, '{$name}', '{$code}');";
        $result = $this->query($sql);
        if (!$result) {
            return null;
        }

        return (int) $this->getLastInsertedId();
    }

    public function updateClient():? bool
    {
        $id = $this->id;
        $cityId = $this->getCityId();
        $name = $this->getName();
        $code = $this->getCode();
        $picture = $this->getPicture();
        $sql = "UPDATE {$this->tableName} SET city_id = $cityId, name = '{$name}', code = '{$code}', picture = '{$picture}' WHERE id = $id;";
        $result = $this->query($sql);
        if (!$result) {
            return false;
        }

        return true;
    }
    
    public function getCLientById():? array
    {
        $id = $this->getId();
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id};";
        
        return $this->getQuery($sql);            
    }
}
