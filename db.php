<?php
  
 
class db{
    private $host="localhost";
    private $dbname="phpQena";
    private $user="root";
    private $password="";
    private $dbtype="mysql";
    private $connection;

    public function __construct(){

         $this->connection= new pdo("$this->dbtype:host=$this->host; dbname=$this->dbname", $this->user,$this->password);
    }
    function get_connection(){
return $this->connection;
    }
    function select($column ,$table ,$condition){
   return $this->connection->query  ("select $column from $table where $condition");
    }

    function delete($table,$condition){
          return $this->connection->query ("delete from $table where $condition");
    }
    function insert ($table ,$value){
        return $this->connection->query ("INSERT into $table set $value");
    }
    function update($table,$value,$condition){
        return $this->connection->query("update $table set $value where $condition");
    }
      function show($column ,$table){
   return $this->connection->query  ("select $column from $table");
    }
}
?>
