<?php

include_once  "Controller/Controller.php";

session_start();

define('URL', 'http://localhost');




if(!isset($_SESSION['Controller'])){
    $Controller = new Controller();
}
else{
    $Controller = unserialize($_SESSION['Controller']);
}


    $requestedView = $_GET["requestedView"];
    $requests = explode("/", $requestedView);
    $count = count($requests);
    
    if($count>=1){
        $firstReq = strtolower($requests[0]);
    }
    if($count>=2){
        $secondReq = strtolower($requests[1]);
    }
    
    
   
    $signedIn = $Controller->isUserSignedIn();
    $isadmin = $Controller->isUserAdmin();
    
  
   
    if($firstReq == "userinteraction" ){
        echo "USER INTERACTION !!";
        processUserinteractionData($Controller);
    }
    elseif($firstReq == "logout"){
        $Controller->logout();
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
    elseif($firstReq == "error" && $count == 1){
        $Controller->displayView("ErrorView");
    }

    else{
        echo "PAGE NOT FOUND!";
        echo"got = $firstReq";
        gotoView("/Error");
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
    $_POST = array(); 
}

function gotoView($view){
    $controller = $GLOBALS["Controller"];
    $_SESSION['Controller'] = serialize($controller);
    header('Location: '.URL.$view);
    exit;
}




?>