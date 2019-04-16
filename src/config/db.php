<?php

class db{
    
    // Database Properties
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'cmanager';

    // Make Database Connection
    public function connect(){

        // make pdo connection to host and database
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";

        // connect pdo with connection string and user then database password
        $connection = new PDO($mysql_connect_str, $this->user, $this->pass);

        // set attribute of errormode and exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // return database connection
        return $connection;
    }
}
