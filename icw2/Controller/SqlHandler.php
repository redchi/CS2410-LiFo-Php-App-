<?php
include_once 'Model/DatabaseManager.php';
class SqlHandler{
    
    private $Model;

    public function __construct(){
        $this->Model = new DatabaseManager();
    }
    
    
    
    public function getAllUserIds(){
        $sql = "SELECT UserID FROM users";
        $result = $this->Model->queryDatabase($sql);
        echo "<br><h1>yee yee ".$result."<br><\h1>";
    }
    
    
    
    
    
    
    
}





?>