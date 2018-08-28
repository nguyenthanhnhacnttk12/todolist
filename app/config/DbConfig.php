<?php
/*---------------------  Nguyenthanhnha.cnttk12@gmail.com ----------------------*/
class DbConfig 
{    
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'todolist';
    
    protected $connection;
    
    public function __construct()
    {
        if (!isset($this->connection)) {
            
            // use mysqli to connecting database 
            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

            // set UTF-8 
            mysqli_set_charset($this->connection, 'UTF8');

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
        return $this->connection;
    }
}
?>