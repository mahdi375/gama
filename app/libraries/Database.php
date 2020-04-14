<?php
/*
*   PDO class
*   connect to database at istantiating
*   return rows as object
*
*/

class Database {
    //database info
    private $host = HOST;
    private $dbName=DB_NAME;
    private $dbUser=DB_USER;
    private $dbPass=DB_PASSWORD;

    private $dbh;
    private $stmt;
    private $error;

    //try to connect to database
    public function __construct()
    {
        $dsn="mysql:host=$this->host;dbname=$this->dbName";
        $options=[
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        //tring
        try{
            $this->dbh = new PDO($dsn,$this->dbUser,$this->dbPass,$options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    //query to database
    public function query($sql)
    {
        $this->stmt =$this->dbh->prepare($sql);
    }
    //bind values
    public function bind($param,$value,$type=null)
    {
        if(is_null($type)){
            switch(true){
                case is_bool($value):
                    $type=PDO::PARAM_BOOL;
                break;
                case is_numeric($value):
                    $type=PDO::PARAM_INT;
                break;
                case is_null($value):
                    $type=PDO::PARAM_NULL;
                break;
                default:
                    $type=PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value,$type);
    }
    //execute
    public function execute()
    {
        return $this->stmt->execute();
    }
    //get Single record
    public function getSingle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //get many records
    public function getResults()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //get result count
    public function getCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }
}
?>