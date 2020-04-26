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
    
    
    
    
    public function getUser($username){
        $sql = "SELECT * FROM users WHERE Username = :username";
        $namedParams = array("username"=>$username);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        if(isset($resultObjs[0])){
            return $resultObjs[0];
        }
        else{
            return false;
        }
    }
    
    public function getUserByID($ID){
        $sql = "SELECT * FROM users WHERE UserID = :userID";
        $namedParams = array("userID"=>$ID);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        return $resultObjs[0];
    }
    
    public function getUserByEmail($email){
        echo "called ! email - $email";
        $sql = "SELECT * FROM users WHERE Email = :email";
        $namedParams = array("email"=>$email);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        if(isset($resultObjs[0]->Username)){
            return $resultObjs[0];
        }
        else{
            return false;
        }
    }
    
    public function updateUserPassword($UserID,$newHashedPassword){
        $sql = "UPDATE users SET HashedPassword=:newPassword WHERE UserID = :userID;";
        $namedParams = array("newPassword"=>$newHashedPassword,"userID"=>$UserID);
        $this->Model->queryDatabase($sql,$namedParams);
    }
    
    
    public function getAllItems(){
        $sql = "SELECT * FROM items;";
       // $namedParams = array("limit"=>$limit,"offset"=>$offset);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams);
        return $resultObjs;
    }
    
    public function getAllItemsCount(){
        $sql = "SELECT COUNT(Name) AS count FROM items;";
        $outputObj =$this->Model->queryDatabase($sql);
        $result =(int)$outputObj[0]->count;
        return $result;
    }
    
    public function insertUser($username,$email,$hashedPassword){
       $sql = "INSERT INTO users ( Username, Email, HashedPassword) VALUES (:username,:email,:pwd)"; 
       $namedParams = array("username"=>$username,"email"=>$email,"pwd"=>$hashedPassword);
       $this->Model->queryDatabase($sql,$namedParams);
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
    
    public function addItem($itemDetails,$userID = 3){
        $itemID = 0;
        $sql =   "INSERT INTO Items (Name, Description, Category,Colour,Location,DateFound,PhotosFolderLoc)
              VALUES (:name, :desc, :cat,:colour,:loc,:date,:pic);";
        $namedParams = array("name"=>$itemDetails["name"],"desc"=>$itemDetails["desc"],"cat"=>$itemDetails["category"],
            "colour"=>$itemDetails["colour"],"loc"=>$itemDetails["location"],"date"=>$itemDetails["date"],"pic"=>"remove this col!");
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams,$itemID);
        
        $sql = "INSERT INTO userstofounditems (ItemID,UserID) VALUES (:itemID,:userID)";
        $namedParams = array("itemID"=>$itemID,"userID"=>$userID);
        
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams); 
        
        return $itemID;
    }
    

    public function addRandomEntries(){
        $count = 0;
        $cats = array("Pet","Jewllery","Phone");  
        $itemColour = "red";
        $itemLoc = "birmingham";
        $itemDateFound = "2020-04-17";
        $itemsPhto = "/pics";
        $adminID = 3;
        
        for ($i = 0; $i <= 30; $i++) {
            echo "The number is: $i <br>";
            $itemName = "item - " . $i;
            $itemDesc = "$itemName description ";
            $itemCat = $cats[rand(0,2)];
            $itemID = 0;
            $sql =   "INSERT INTO Items (Name, Description, Category,Colour,Location,DateFound,PhotosFolderLoc)
              VALUES (:name, :desc, :cat,:colour,:loc,:date,:pic);";
            
            $namedParams = array("name"=>$itemName,"desc"=>$itemDesc,"cat"=>$itemCat,
                "colour"=>$itemColour,"loc"=>$itemLoc,"date"=>$itemDateFound,"pic"=>$itemsPhto);
            
            $resultObjs = $this->Model->queryDatabase($sql,$namedParams,$itemID);
            $sql = "INSERT INTO userstofounditems (ItemID,UserID) VALUES (:itemID,:userID)";
            $namedParams = array("itemID"=>$itemID,"userID"=>$adminID);
            $resultObjs = $this->Model->queryDatabase($sql,$namedParams);          
        }

    }
    
    
    public function insertRequest($requestDescription,$requestedItemID,$requesterUserID){
        $sql = "INSERT INTO requests (Description) VALUES (:requestDesc)";
        $namedParams = array("requestDesc"=>$requestDescription);
        $RequestID = 0;
        $this->Model->queryDatabase($sql,$namedParams,$RequestID);   
        $sql = "INSERT INTO requeststouseranditem (RequestID, ItemID, UserID) VALUES (:requestID,:itemID,:userID);";
        $namedParams = array("requestID"=>$RequestID,"itemID"=>$requestedItemID,"userID"=>$requesterUserID);
        $this->Model->queryDatabase($sql,$namedParams);
    }
    
    public function getRequest($RequestID){
        $sql = "SELECT * FROM requests WHERE RequestID = :requestID";
        $namedParams = array("requestID"=>$RequestID);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams); 
        return $resultObjs[0];
    }
    
    public function getRequestAndRelatedObjs($RequestID){
        $sql = "SELECT * FROM  requeststouseranditem WHERE RequestID = :requestID";
        $namedParams = array("requestID"=>$RequestID);
        $resultObjs = $this->Model->queryDatabase($sql,$namedParams); 
        $obj = $resultObjs[0];
        $userID = $obj->UserID;
        $itemID = $obj->ItemID;
        $requestID = $obj->RequestID;
        $user  = $this->getUserByID($userID);
        $item = $this->getItem($itemID);
        $request = $this->getRequest($requestID);
        $entry = array("item"=>$item["item"],"user"=>$user,"request"=>$request);
        return $entry;
        
    }
    
    public function getAllRequestsCount(){
        $sql = "SELECT COUNT(RequestID) AS count FROM requests;";
        $outputObj =$this->Model->queryDatabase($sql);
        $result =(int)$outputObj[0]->count;
        return $result;
    }
    
    public function getAllRequests(){
        $sql = "SELECT * FROM requeststouseranditem;";
    //    $namedParams = array("limit"=>$limit,"offset"=>$offset);
        $resultObjs = $this->Model->queryDatabase($sql);  
       
        $outputArray = array();
        foreach($resultObjs as $obj){
            $userID = $obj->UserID;
            $itemID = $obj->ItemID;
            $requestID = $obj->RequestID;
            $user  = $this->getUserByID($userID);
            $item = $this->getItem($itemID);
            $request = $this->getRequest($requestID);
            $entry = array("item"=>$item["item"],"user"=>$user,"request"=>$request);
            echo "<br><br> #### START";
            echo print_r($entry);
            echo "<br><br>";
            
            array_push($outputArray,$entry);
        }
        echo print_r($outputArray);
        return $outputArray;
    }
    
    
    public function deleteRequestAndRelatedObjs($requestID,$itemID){
        $sql = "DELETE FROM requests WHERE RequestID = :requestID";
        $namedParams = array("requestID"=>$requestID);
        $this->Model->queryDatabase($sql,$namedParams);
        $sql = "DELETE FROM items WHERE ItemID =:itemID";
        $namedParams = array("itemID"=>$itemID);
        $this->Model->queryDatabase($sql,$namedParams);
    }
    
    public function deleteRequest($requestID){
        $sql = "DELETE FROM requests WHERE RequestID = :requestID";
        $namedParams = array("requestID"=>$requestID);
        $this->Model->queryDatabase($sql,$namedParams);
    }
}





?>