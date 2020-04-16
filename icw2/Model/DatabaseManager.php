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
    }
    
    // returns objects of rows
    public function queryDatabase($sql,$namedParams = array()){
        $this -> connectToDatabase();
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->execute($namedParams);
        $resultObjs = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $this->DBConnect = null;
        return $resultObjs;
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
		SELECT LAST_INSERT_ID();
       
 
 * 
 */






    }



    ?>








