<?php

include_once  "Controller/Controller.php";


if(!isset($_SESSION['Controller'])){
    $Controller = new Controller();    
}
else{
    $Controller = unserialize($_SESSION['Controller']);
}
 

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