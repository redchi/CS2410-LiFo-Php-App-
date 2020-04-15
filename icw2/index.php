<?php

include_once  "Controller/Controller.php";

echo "#1";
if(!isset($_SESSION['Controller'])){
    $Controller = new Controller();
    echo "#2";
}
else{
    $Controller = unserialize($_SESSION['Controller']);
    echo "#3";
}
 
echo "#4";
//$t = $_POST[0];
echo print_r($_POST);
    
    $key = key($_POST);
    $data = null;
    if($key != null){
      $data = $_POST[$key];
    }
    $_POST = array();
    $Controller ->invoke($key, $data);



?>