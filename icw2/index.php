<?php

include_once  "Controller/Controller.php";

echo"<h3> post =  ".print_r($_POST)."</h3><br>";
//echo "<br> file = ".$_FILES['file']["name"]."<br>";
session_start();

define('URL', 'http://localhost');


echo"<h3> requestedView =  ".print_r($requests)."</h3><br>";


if(!isset($_SESSION['Controller'])){
    echo" ## session not set!";
    $Controller = new Controller();
    //$controllerFound = false;
}
else{
    $Controller = unserialize($_SESSION['Controller']);
    //$controllerFound = true;
}




if(empty($requestedView)){
    echo "not set";
}

 
    $requestedView = $_GET["requestedView"];
    $requests = explode("/", $requestedView);
    $firstReq = strtolower($requests[0]);
    $secondReq = strtolower($requests[1]);
    $count = count($requests);
    $signedIn = $Controller->isUserSignedIn();
    $isadmin = $Controller->isUserAdmin();
    
    echo "<br><h2>";
    echo $Controller->loggedInUsername;
    
    if($signedIn == true){
        echo " signed in";
    }
    else{
        echo "not signed in";
    }
        
        echo "<br></h2>";
    
    echo "<h1> 1 $signedIn</h1>";
    if($firstReq == "userinteraction" ){
        echo "USER INTERACTION !!";
        processUserinteractionData($Controller);
    }
    elseif(empty($requestedView)){
        if($signedIn == true){
            gotoView("/Home");
        }
        else{
            gotoView("/Intro");
        }
    }
    elseif($firstReq == "intro" && $count == 1){
        if($signedIn == true){
            gotoView("/Home");
        }
        else{
            $Controller->displayView("IntroScreenView");
        }       
    }
    elseif($firstReq == "home" && $count == 1){
        $Controller->displayView("HomeView");
    }
    elseif($firstReq == "login" && $count == 1){
        $Controller->displayView("LoginView");
    }
    elseif($firstReq == "register" && $count == 1){
        $Controller->displayView("RegisterView");
    }
    elseif($firstReq == "forgot_password" && $count == 1){
        $Controller->displayView("ForgotPassword");
    }
    elseif($firstReq == "reset_code_enter" && $count == 1){
        $Controller->displayView("ResetCodeView");
    }
    elseif($firstReq == "reset_password" && $count == 1){
        $Controller->displayView("ResetPasswordView");
    }
    elseif($firstReq == "all_items" && $count == 1){
        $Controller->displayView("ItemsTableView");
    }
    elseif($firstReq == "view_item" && $count == 2){
        echo "view item = ". $secondReq;
        if($signedIn == true){
            $dataPassed = array("itemID" =>$secondReq );
            $Controller->displayView("ItemDetailsView",$dataPassed);
        }
        else{
            gotoView("/All_items");
        }
        
    }
    elseif($firstReq == "request_item" && $count == 2){
        if($signedIn == true){
            $dataPassed = array("itemID" =>$secondReq);
            $Controller->displayView("RequestItemView",$dataPassed);
        }
        else{
            gotoView("/All_items");
        }
        
       
    }
    elseif($firstReq == "add_item_category" && $count == 1){
        if($signedIn == true){
            $Controller->displayView("SelectItemCategoryView");
        }
        else{
            gotoView("/Home");
        }
    }
    elseif($firstReq == "add_item_details" && $count == 1){
        if($signedIn == true){
            $Controller->displayView("AddItemDetailsView");
        }
        else{
            gotoView("/Home");
        }  
    }
    elseif($firstReq == "add_item_photos" && $count == 1){
        if($signedIn == true){
            $Controller->displayView("AddItemPhotosView");
        }
        else{
            gotoView("/Home");
        }  
    } 
    elseif($firstReq == "all_item_requests" && $count == 1){
        if($isadmin == true){
            $Controller->displayView("AllRequestsView");
        }
        else{
            gotoView("/Home");
        }
    }
    
    
    
    
    elseif($firstReq == "view_item_request" && $count == 2){
        if($isadmin == true){
            $dataPassed = array("requestID" =>$secondReq);
            $Controller->displayView("RequestDetailsView",$dataPassed);
        }
        else{
            gotoView("/Home");
        }
    }
    elseif($firstReq == "home" && $count == 1){
        
    }
    elseif($firstReq == "home" && $count == 1){
        
    }
    else{
        echo "PAGE NOT FOUND!";
        echo"got = $firstReq";
        // page not found
        //http://localhost/UploadedImages/107/0.png
        //$Controller->displayView("pagenotfound");
        
    }


function processUserinteractionData($Controller){
    if(count (array_keys ($_POST))>1){
        $method_name=null;
        foreach((array_keys ($_POST)) as $key){
            if(method_exists ($Controller, $key)){
                $method_name = $key;
                unset($_POST[$key]);
            }
        }
        $Controller->UserInteractionHandle($method_name,$_POST);
    }
    
    else if(count(array_keys($_POST)) == 1){
        $method_name = key($_POST);
        $data = $_POST[$method_name];
        $Controller ->UserInteractionHandle($method_name, $data);
    }
    
    else {
        $Controller ->UserInteractionHandle(null, null);
    }
    // echo"##x3##".$Controller->currentView;
    $_POST = array(); 
}

function gotoView($view){
    $controller = $GLOBALS["Controller"];
    $_SESSION['Controller'] = serialize($controller);
    header('Location: '.URL.$view);
    exit;
}

//echo 'br><a href="home/home">link text</a>'


//    // echo"##x2##".$Controller->currentView;
    


?>