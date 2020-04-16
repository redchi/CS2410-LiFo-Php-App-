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
    
    public function getAllItems($limitMin,$limitMax){
        $sql = "SELECT * FROM items LIMIT :minLimit , :maxLimit;";
        $namedParams = array("minLimit"=>$limitMin,"maxLimit"=>$limitMax);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        return $resultObjs;
    }
    
    public function getAllItemsCount(){
        $sql = "SELECT COUNT(Name) AS count FROM items;";
        $outputObj =$this->Model->queryDatabase($sql);
        $result =(int)$outputObj[0]->count;
        return $result;
    }

    
}





?>