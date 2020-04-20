<?php
class DatabaseManager{
    
    private $DBConnect;
    public function __construct(){
    //nothing
        
    }
    
    private function connectToDatabase(){
        $Server_name = "localhost";
        $username = "root";
        $pwd = "";
        $database_name = "lifo db 1";       
        $this ->DBConnect = mysqli_connect($Server_name,$username,$pwd ,$database_name );
       // add try catch here!
       
        $dsn = "mysql:host=".$Server_name.";dbname=".$database_name;        
        $this->DBConnect = new PDO($dsn,$username,$pwd);
        $this->DBConnect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    
    // returns objects of rows
    public function queryDatabase($sql,$namedParams = array(),&$lastInsertedID = 0){
        $this -> connectToDatabase();
        $stmt = $this->DBConnect->prepare($sql);
        echo print_r($namedParams);
        $stmt->execute($namedParams);
        if ( strstr( $sql, 'INSERT' ) ) {
            $lastInsertedID = $this->DBConnect->lastInsertId();
        } 
       
        $resultObjs = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $this->DBConnect = null;
        return $resultObjs;
    }
    
   
    
    
    public function x1(){
        $this -> connectToDatabase();
        $sql = "SELECT * FROM items WHERE Name = :name  LIMIT :x1;";
        $in = 2;
        if(gettype($in) == "integer"){
            echo "yeeeeeeeeeee";
        }
        
     
        
        $namedParams = array("x1"=>2,"name"=>"itemtest");
        
        $stmt = $this->DBConnect->prepare($sql);
        
        
//         foreach(array_keys($namedParams) as $key){
//             $value = $namedParams[$key];
//             echo "<br><h1>key = $key  val = $value<br></h1>";
//             if(gettype($value) == "integer"){
//                 $stmt->bindParam($key, $value, PDO::PARAM_INT);
//                 unset($namedParams[$key]);
//                 echo "<h1>passed</h1>";
//             }
//         }
        
        
        
        
        echo "<br> lr".print_r(array_keys($namedParams))." e<br>";
        
        
        $stmt->execute($namedParams);
        $stmt->debugDumpParams();
        echo "<br> ##1<br>";
        $resultObjs = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($resultObjs as $obj){
            echo "<br> name = ".$obj->Name;
        }
        $stmt->closeCursor();
        $this->DBConnect = null;
    }

    
    
    
//  

    //database table creation
/*
 * 
    CREATE TABLE Users (
      UserID int NOT NULL AUTO_INCREMENT,
      Username varchar(255) NOT NULL UNIQUE,
      Email varchar(255) NOT NULL UNIQUE,
      HashedPassword varchar(255) NOT NULL,
      PRIMARY KEY (UserID)
    );
    
    
   CREATE TABLE Items (
        ItemID int NOT NULL AUTO_INCREMENT,
        Name varchar(255) NOT NULL,
        Description varchar(1000),
        Category varchar(255) NOT NULL,
        Colour varchar(255) NOT NULL,
        Location varchar(255) NOT NULL,
        DateFound DATE NOT NULL,
        PhotosFolderLoc varchar(500),
        PRIMARY KEY(ItemID)
        );
       
       
        CREATE TABLE UsersToFoundItems (
            ItemID int NOT NULL,
           	UserID int NOT NULL,      
           	CONSTRAINT ItemID_FK FOREIGN KEY (ItemID) REFERENCES Items (ItemID) ON DELETE CASCADE    
        );
       
       
       
       INSERT INTO Items (Name, Description, Category,Colour,Location,DateFound,PhotosFolderLoc)
        VALUES ("itemtest", "desc", "catx","red",Birmingham,"1000-01-01","pics/");     
       
       use like
       
        INSERT INTO Items (Name, Description, Category,Colour,Location,DateFound,PhotosFolderLoc)
        VALUES ("iteasdmtest", "desc", "catx","red","Birmingham","1000-01-01","picsads/");       
		SELECT LAST_INSERT_ID() AS LastID;
       
 
 * 
 */






    }



    ?>








