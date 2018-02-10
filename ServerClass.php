<?php

require_once 'DatabaseClass.php';

class Server
{
    private $db;
    
    public function __construct() 
    {
        $this->db = new DatabaseClass();
    }
    
    public function insert()
    {
        $values = [];
        
        $values['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $values['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $values['content'] = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        
        echo $this->db->insert($values);
    }
    
    public function fetch(int $id = 0)
    {
        header('Content-Type: application/json');
        
        $result = $this->db->fetch($id);
        echo json_encode(['data' => $result]);
    }
    
    public function __call($name = '', $args = null)
    {
        echo 'Błąd...';
    }
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (!empty($action)) {
    $server = new Server();
    
    if ($action == 'fetch') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        echo $server->fetch($id);
    } else {
        $server->$action();
    }
} else {
    echo 'Błąd';
}