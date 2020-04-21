<?php
include_once 'View/IntroScreenView.php';
include_once 'View/ItemsTableView.php';
include_once 'View/ItemDetailsView.php';
include_once 'View/AddItemViews/AddItemDetailsView.php';
include_once 'View/AddItemViews/AddItemPhotosView.php';
include_once 'View/AddItemViews/SelectItemCategoryView.php';
include_once 'View/RequestItemView.php';
include_once 'View/LoginViews/ForgotPassword.php';
include_once 'View/LoginViews/LoginView.php';
include_once 'View/LoginViews/RegisterView.php';
include_once 'View/LoginViews/ResetCodeView.php';
include_once 'View/LoginViews/ResetPasswordView.php';

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