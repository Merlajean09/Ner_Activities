<?php

class Database{
    public $conn;
    public function connect(){
        $this->conn = new mysqli('locahost', 'root', '', 'test');
    }
}

?>