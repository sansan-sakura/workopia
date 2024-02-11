<?php


class Database {
    public $conn;


    /**
     * Contstructor for Database class
     * 
     * @param array $config
     */
    
     public function __construct($config)
     {
$dsn="mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";


$options=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
];

try{
    $this->conn=new PDO($dsn, $config['username'],$config['password'],$options);
} catch(PDOException $e){
    throw new Exception(("Database connecttion failded: {$e->getMessage()}"));
}
     }


/**
 * 
 * Query the database
 * 
 * @param string $query
 * @return PDOStatement
 * @throws PDOException
 */


 public function query ($query){
   try{
    $sth=$this->conn->prepare($query);
    $sth->execute();
    return $sth;
   } catch (PDOException $e){
    throw new Exception(("Query failded to execute: {$e->getMessage()}"));
   }
 }

}

