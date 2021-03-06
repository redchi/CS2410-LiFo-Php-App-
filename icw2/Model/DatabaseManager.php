<?php
/*
 * CS2410 Internet Applications and Techniques Coursework
 * Aston University - Asim Younas - 180050734 - April 2020
 *
 */

/*
 * the model used
 * uses PDO and prepared statements for protection against SQL Injection attacks
 */
class DatabaseManager{
    
    private $DBConnect;
    public function __construct(){
    //nothing
        
    }
    
    /*
     * Connects to the database
     */
    private function connectToDatabase(){
        $Server_name = "localhost";
        $username = "u-180050734";
        $pwd = "hLAgNVPO6U67Nrn";
        $database_name = "u_180050734_db";       
        $this ->DBConnect = mysqli_connect($Server_name,$username,$pwd ,$database_name );
        $dsn = "mysql:host=".$Server_name.";dbname=".$database_name;        
        $this->DBConnect = new PDO($dsn,$username,$pwd);
        $this->DBConnect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    
    /*
     * query the database
     * uses PDO to prepare the statement
     * then passes in the namedParams and executes it
     * 
     * params = sql,namedparams, (by ref) lastInsertedID - if an insert is executed then changes this variable to lasted inserted ID
     * returns an array of PDO objects
     */
    public function queryDatabase($sql,$namedParams = array(),&$lastInsertedID = 0){
        $this -> connectToDatabase();
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->execute($namedParams);
        if ( strstr( $sql, 'INSERT' ) ) {
            $lastInsertedID = $this->DBConnect->lastInsertId();
        } 
       
        $resultObjs = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $this->DBConnect = null;
        return $resultObjs;
    }
    
   
    
    

    
    
    
// DATABASE SCHEMA 
/*
 * 
    CREATE TABLE users (
      UserID int NOT NULL AUTO_INCREMENT,
      Username varchar(255) NOT NULL UNIQUE,
      Email varchar(255) NOT NULL UNIQUE,
      HashedPassword varchar(255) NOT NULL,
      PRIMARY KEY (UserID)
    );
    
    
   CREATE TABLE items (
        ItemID int NOT NULL AUTO_INCREMENT,
        Name varchar(255) NOT NULL,
        Description varchar(1000),
        Category varchar(255) NOT NULL,
        Colour varchar(255) NOT NULL,
        Location varchar(255) NOT NULL,
        DateFound DATE NOT NULL,
        PRIMARY KEY(ItemID)
        );
       
       
        CREATE TABLE userstofounditems (
            ItemID int NOT NULL,
           	UserID int NOT NULL,      
           	CONSTRAINT ItemID_FK FOREIGN KEY (ItemID) REFERENCES items (ItemID) ON DELETE CASCADE,    
            CONSTRAINT UserID_FK FOREIGN KEY (UserID) REFERENCES users (UserID) ON DELETE CASCADE
        );
        
        CREATE TABLE requests(
            RequestID int NOT NULL AUTO_INCREMENT,
      		Description varchar(1000)NOT NULL,
            PRIMARY KEY(RequestID)
        );
       
         CREATE TABLE requeststouseranditem (
            RequestID int NOT NULL,
      		ItemID int NOT NULL,
           	UserID int NOT NULL,	
           	CONSTRAINT ItemID_FK2 FOREIGN KEY (ItemID) REFERENCES items (ItemID) ON DELETE CASCADE,
      		CONSTRAINT RequestID_FK FOREIGN KEY (RequestID) REFERENCES requests (RequestID) ON DELETE CASCADE,
            CONSTRAINT UserID_FK2 FOREIGN KEY (UserID) REFERENCES users (UserID) ON DELETE CASCADE
        );
        
        
        
        
        

 
 * 
 */






    }



    ?>








