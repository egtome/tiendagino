<?php
/**
 * Description of Model
 * Model core
 * @author gino
 */

class Model{
    private $host;
    private $db;
    private $user;
    private $passsword;
    public $conn = null;
    public $error;

    public function __construct()
    {
        if ($this->conn === null) {
            $this->setHost(DB_HOST);
            $this->setDb(DB_NAME);
            $this->setUser(DB_USER);
            $this->setPasssword(DB_PASSWORD);
            try{
                $this->conn = mysqli_connect($this->host,$this->user,$this->passsword,$this->db);
                $this->error = mysqli_connect_error();
            }catch(Throwable $t){
                $this->error = $t->getMessage($this->conn);
            }
        }
    }

    
    public function query($sql)
    {
        if($this->conn->query($sql)){
            return true;
        }else{
            return mysqli_error($this->conn);
        }
    }

    public function getLastInsertedId()
    {
        return $this->conn->insert_id;
    }
    
    public function getQuery($sql)
    {
        $r = [];
        $res = $this->conn->query($sql);
        if($res){
            while($row = mysqli_fetch_assoc($res)){
                $r[] = $row;
            }
            return $r;
        }else{
            return mysqli_error($this->conn);
        }
    }
    
    public function close()
    {
        mysqli_close($this->conn);
        $this->conn = null;
    }

    /**
     * Get the value of host
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */ 
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of passsword
     */ 
    public function getPasssword()
    {
        return $this->passsword;
    }

    /**
     * Set the value of passsword
     *
     * @return  self
     */ 
    public function setPasssword($passsword)
    {
        $this->passsword = $passsword;

        return $this;
    }
}
