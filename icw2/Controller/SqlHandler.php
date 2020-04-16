<?php
include_once 'Model/DatabaseManager.php';
class SqlHandler{
    
    private $Model;

    public function __construct(){
        $this->Model = new DatabaseManager();
    }
    
    
    
    public function getAllUserIds(){
        $sql = "SELECT * FROM users";
        $resultObjs = $this->Model->queryDatabase($sql);
        foreach($resultObjs as $rowObj){
            echo "<br><h1> email =".$rowObj->Email."<br></h1>";
        }
    }
    
    public function getAllItems(){
        $sql = "SELECT * FROM items";
        $resultObjs = $this->Model->queryDatabase($sql);
        return $resultObjs;
    }
    
    
    
    
    
    
}





?>