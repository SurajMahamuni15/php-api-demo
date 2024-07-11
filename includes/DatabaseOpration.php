<?php



class DatabaseManager{

    private $server;
    private $username;
    private $password;
    private $conn_pdo;

    function __construct($server,$username,$password){
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
    }

    function createDatabase($databaseName){
        $con = new mysqli($this->server,$this->username,$this->password);
        $sql = "CREATE DATABASE $databaseName";
        if (mysqli_query($con, $sql)) {
          echo "Database created successfully";
        } else {
          echo "Error creating database: ";
        }
    }

    function connectionEstablish($dbname_){
        try{
            $this->conn_pdo = new PDO("mysql:host=$this->server;dbname=$dbname_;charset=utf8",$this->username,$this->password);
            $this->conn_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo("Connection error=> $e->getMessage()");
        }
    }

    function getConnectionInstance(){
        return $this->conn_pdo;
    }
}

?>