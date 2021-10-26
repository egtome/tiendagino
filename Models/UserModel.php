<?php
/**
 * Description of Users Model
 *
 * @author gino
 */
class UserModel extends Model { 
    private $tableName = 'users';
    private $userName;
    private $password;
    
    public function storeLog(){
        $sql = "INSERT INTO {$this->tableName} (log_time,log_message) VALUES ('{$this->logTime}','{$this->logMessage}');";
        $this->query($sql);
    }

    public function getUsers(): array
    {
        $sql = "SELECT * FROM {$this->tableName};";
        return $this->getQuery($sql);
    }

    public function getPasswordByUserName(): ?array
    {
        $sql = "SELECT password FROM {$this->tableName} WHERE username = '{$this->userName}';";

        return $this->getQuery($sql);
    }   
    
    function getUserName(): string 
    {
        return $this->userName;
    }

    function getPassword(): string 
    {
        return $this->password;
    }

    function setUserName(string $userName): void 
    {
        $this->userName = $userName;
    }

    function setPassword(string $password): void 
    {
        $this->password = $password;
    }    
}
