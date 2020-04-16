<?php
include_once 'View/IntroScreenView.php';
include_once 'View/ItemsTableView.php';
include_once 'View/LoginView.php';
include_once 'View/RegisterView.php';

Class View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        if(isset($data["error"])){
            $this->DisplayError($data["error"]);
        }
        else{
            echo"#2";
        }
        // html goes here
    }
    
    protected function DisplayError($error){
        echo "<script type='text/javascript'>alert('$error');</script>";  
    }

}

?>