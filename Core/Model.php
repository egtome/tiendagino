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
        $sql = $sql;
        if (!$this->conn->query($sql)) {
            return mysqli_error($this->conn);
        }

        return true;
    }

    public function getLastInsertedId(): int
    {
        return $this->conn->insert_id;
    }
    
    public function getQuery($sql)
    {
        $sql = $sql;
        $data = [];
        $result = $this->conn->query($sql);
        if (!$result) {
            return mysqli_error($this->conn);
        }
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }
    
    public function close(): void
    {
        mysqli_close($this->conn);
        $this->conn = null;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db): void
    {
        $this->db = $db;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getPasssword(): string
    {
        return $this->passsword;
    }

    public function setPasssword($passsword): void
    {
        $this->passsword = $passsword;
    }

    protected function getEscapedstring(string $query): string
    {
        return mysqli_real_escape_string($this->conn, $query);
    }
}
