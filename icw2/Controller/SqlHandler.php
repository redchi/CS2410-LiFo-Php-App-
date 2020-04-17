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
    
    public function getItem($itemID){
        $sql = "SELECT * FROM items WHERE ItemID = :itemID;";
        $namedParams = array("itemID"=>$itemID);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        $itemObj = $resultObjs[0];
        
        $sql = "SELECT users.Username,users.Email 
                FROM users,items,userstofounditems
                WHERE users.UserID = userstofounditems.UserID
                AND items.ItemID = userstofounditems.ItemID
                AND items.ItemID = :itemID;";
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        $UserObj = $resultObjs[0];
        
        $returnObjs = array("item"=>$itemObj,"user"=>$UserObj);
        return $returnObjs;
    }
    

    
}





?>