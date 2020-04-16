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
    }
    
    public function queryDatabase($SQL_query){
        $this->connectToDatabase();
        $result = mysqli_query($this ->DBConnect,$SQL_query);
        if (mysqli_num_rows($result) > 0) {
            // for error handling
            
            
        }
        
        return $result;
    }
    
    
    public function processQueryResult($query_result,$col_name){
        $output = [];    
        while(($row = mysqli_fetch_assoc($query_result)[$col_name])){
            array_push($output , $row);
           // echo($row."xr");
        }
        return $output;
    }  
}


    //database table creation
/*
 * CREATE TABLE Users (
      UserID int NOT NULL AUTO_INCREMENT,
      Username varchar(255) NOT NULL UNIQUE,
      Email varchar(255) NOT NULL UNIQUE,
      HashedPassword varchar(255) NOT NULL,
      PRIMARY KEY (UserID)
    );
 * 
 * 
 * 
 * 
 */



















?>