<?php

class DatabaseClass
{   
    private $db;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'shoutbox';
    
    
    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );
                
            $this->db->exec("SET NAMES 'utf8';
			SET character_set_connection=utf8;
			SET character_set_client=utf8;
			SET character_set_results=utf8");
                
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    
    public function __destruct()
    {
        $this->db = null;
    }
    
    public function fetch(int $id = 0)
    {
        try {
            return $this->db->query("SELECT id, name, content, created_at FROM shoutbox WHERE id > {$id} ORDER BY created_at ASC")->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function insert(array $values = []) : int
    {
        if (!empty($values)) {
            try {
                $stmt = $this->db->prepare('INSERT INTO shoutbox (email, name, content) VALUES(:email, :name, :content)');
                
                foreach ($values AS $key => $value) {
                    $stmt->bindValue(":{$key}", $value);
                }
                
                $stmt->execute();
                return $this->db->lastInsertId();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        return -1;
    }
    
}
