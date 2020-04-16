<?php
include_once 'Model/DatabaseManager.php';
class SqlHandler{
    
    private $Model;

    public function __construct(){
        $this->Model = new DatabaseManager();
    }
    
    
    
    public function getAllUserIds(){
        $sql = "SELECT * FROM users";
        $result = $this->Model->queryDatabase($sql);
        $ids = $this->Model->processQueryResult($result, "UserID");
        $t1 = $ids[0];
        echo "<br><h1>yee yee ".$t1."<br></h1>";
    }
    
    
    
    
    
    
    
}





?>