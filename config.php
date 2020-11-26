<?php
class config
{
    public $url;
    public   $username;
    public $password;
    public $dbname;
    public $conn;
    function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'cab');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // echo "Succssfull";
        }
    }
}