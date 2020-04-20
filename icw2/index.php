<?php

include_once  "Controller/Controller.php";

echo"<h3> post =  ".print_r($_POST)."</h3><br>";
//echo "<br> file = ".$_FILES['file']["name"]."<br>";
    if(!isset($_SESSION['Controller'])){
        $Controller = new Controller();
    }
    else{
        $Controller = unserialize($_SESSION['Controller']);
    }

    if(count (array_keys ($_POST))>1){
        $method_name=null;
        foreach((array_keys ($_POST)) as $key){          
            if(method_exists ($Controller, $key)){
                $method_name = $key;                
                unset($_POST[$key]);
            }
        }
        $Controller->invoke($method_name,$_POST);
    }
    
    else if(count(array_keys($_POST)) == 1){
        $method_name = key($_POST);
        $data = $_POST[$method_name];
        $Controller ->invoke($method_name, $data);
    }
    
    else {
        $Controller ->invoke(null, null);
    }

    $_POST = array();

?>