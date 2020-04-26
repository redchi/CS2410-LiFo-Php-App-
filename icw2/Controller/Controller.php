<?php
include_once "View/View.php";
include_once 'Controller/SqlHandler.php';
include_once 'Controller/SecureRandom.php';
include_once "Controller/Mailer.php";

class  Controller{
    
    private $views;
    private $currentView;
    private $dataPassedToView;
    
    
    private $SqlHandler;
    public $loggedInUsername;
    private $Mailer;  
    
    private $passwordResetCode;
    private $emailUsed;
  
    //private $isUserAdmin;
    
    public function __construct(){
        echo "**NEW CONTROLLER MADE!**";
        $viewNames = array("IntroScreenView","ItemsTableView"
            ,"RegisterView","LoginView","ItemDetailsView","AddItemDetailsView"
            ,"RequestItemView","AddItemPhotosView","SelectItemCategoryView"
            ,"ForgotPassword","ResetCodeView","ResetPasswordView","AllRequestsView"
            ,"RequestDetailsView","HomeView"
        );
        
        foreach($viewNames as $viewName){
            $view = new $viewName();
            $this->views[$viewName] = $view;
        };
        $this->Mailer = new Mailer();
        $this -> SqlHandler = new SqlHandler();
    }
    
    public function isUserSignedIn(){
        echo "#######called usi##############";
        return (!empty($this->loggedInUsername));
    }
    
    
    public function isUserAdmin(){
        return ($this->isUserSignedIn() == true && $this->loggedInUsername =="admin");
    }
    
    
    public function displayView($viewName,$viewParams = array()){
        echo " display view called $viewName ";
        $method_name = "Display".$viewName;
        
        if(is_callable(array('Controller', $method_name))){
            echo "##x1";
            $this->$method_name($viewParams);
        }
        else{
            echo "##x2";
            echo("<br>#### view = ".$viewName."###");
            $this->views[$viewName]->draw($this->dataPassedToView);
        }
        
        $this->currentView = $viewName;
        $this->dataPassedToView = array();
        $this->saveState();  
    }
    
    public function UserInteractionHandle($method,$data){
        
        echo "<h2>method called = $method<br>
       data passed = ".print_r($data)."  </h3> ";
        
        if(!(isset($this -> currentView))){
            echo"<h1> EMPTY !!</h1>";
        }
        
      
        
        if($method == null){
            $this->default();
        }
        else if(is_callable(array('Controller', $method))){
            $this->$method($data);
        }
        else{
            // change this to server error when implemented
            $this->userError("method $method not found");
        }
        echo "<br>current view = ".$this -> currentView."<br>";
        $this->dataPassedToView['loggedInUsername'] = $this->loggedInUsername;
        //$this->DisplayView();
 
        //$this->SqlHandler->getAllRequests();
 
        $this->saveState();  
        
       // $mailer = new Mailer();
        //$mailer->sendTestEmail();
        
        
    }
    
 
    private function default(){
        echo"default called";
        if(isset($this->loggedInUsername)){
            $this -> currentView = "IntroScreenView";          
        }
        $this -> currentView = "IntroScreenView"; 
    }
    
    private function saveState(){
        $_SESSION['Controller'] = serialize($this);
    }
    
    
    
    
//     private function DisplayView(){

        
//     }
    
    private function DisplayIntroScreenView(){
        $this->views["IntroScreenView"]->draw($this->dataPassedToView);
    }
    
    private function DisplayItemsTableView(){
        //$countIndex = 0;
        if(isset($this->dataPassedToView['countIndex'])){
            $countIndex = $this->dataPassedToView['countIndex'];
        }
        
       // echo "count index ## = ".$countIndex;
        $allItems = $this->SqlHandler->getAllItems(); 
        // do validation for query result ! 5 max
        $this -> dataPassedToView["queryResult"] = $allItems;
        $this->views[ItemsTableView]->draw($this->dataPassedToView);
    }
    
    private function DisplayAllRequestsView(){

     //   echo "count index ## = ".$countIndex;
        $allObjs = $this->SqlHandler->getAllRequests();
        // do validation for query result ! 5 max
        $this -> dataPassedToView["queryResult"] = $allObjs;
        $this->currentView =  "AllRequestsView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    private function DisplayItemDetailsView($params){
        echo "x34 called";
        $itemID = $params["itemID"];
        
        $queryResult = $this->SqlHandler->getItem($itemID);
        $item = $queryResult["item"];
        $foundByUser = $queryResult["user"];
        // add validation !
        
        $this->dataPassedToView['item'] = $item;
        $this->dataPassedToView['user'] = $foundByUser;
        $this -> currentView = "ItemDetailsView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    private function DisplayRequestItemView($data){
        echo "yee - ". print_r($data);
        // $username = $data['username'];
        $itemID  = $data['itemID'];
        // $username ="admin";
        $queryResult = $this->SqlHandler->getItem($itemID);
        $item = $queryResult["item"];
        $this->dataPassedToView['item'] = $item;
        $this->currentView = "RequestItemView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
        
    }
    private function DisplayRequestDetailsView($data){
        echo "YEEEEEEEEEEEEEEE";
        $requestID  = $data['requestID'];
        $this->currentView = "RequestDetailsView";
        $resultObjs = $this->SqlHandler->getRequestAndRelatedObjs($requestID);
        $this->dataPassedToView["request"] = $resultObjs;
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//     private function goto($relativePath){
//        $path =  "./$relativePath";
//        header('Location: '.$path);
//        exit;
//     }
    
 
    
    private function approveRequest($RID){
        echo "X1 CALLED";
        $resultObjs = $this->SqlHandler->getRequestAndRelatedObjs($RID);
        $item = $resultObjs["item"];     
        $user = $resultObjs["user"];
        $request = $resultObjs["request"];
        
        $itemID =$item->ItemID;
        $email = $user->Email;
        $this->SqlHandler->deleteRequestAndRelatedObjs($RID, $itemID);
        // send email
        $this->Mailer->sendRequrestApprovedEmail($item, $email);
        
        $dirname ="C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages\\".$itemID;
        if(file_exists($dirname)){
            array_map('unlink', glob("$dirname/*.*"));
            rmdir($dirname);
        }
    }
    
    private function denyRequest($RID){
        $resultObjs  = $this->SqlHandler->getRequestAndRelatedObjs($RID);
        $item = $resultObjs["item"];
        $user = $resultObjs["user"];
        $request = $resultObjs["request"];
        
        $this->SqlHandler->deleteRequest($RID);
        
    }
    
    
    
    
    private function requestTableRowClicked($requestID){
        $this->currentView = "RequestDetailsView";
        $resultObjs = $this->SqlHandler->getRequestAndRelatedObjs($requestID);
        $this->dataPassedToView["request"] = $resultObjs;
    }
    
    private function viewAllRequestsClicked(){
        $this->currentView= "AllRequestsView";
    }
    
    
    
    private function loginAttempt($data){
        echo "loggin attempted";
        $username = strtolower($data["username"]);
        $password  = $data ["password"];
        $valid = true;
        $usernameValid = true;
        $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
        echo "<br>password = <br> $hashedPassword <br>";
        // check if username is valid
        if(!(preg_match('/^[a-zA-Z0-9]{5,}$/', $username))) { // for english chars + numbers only
            // valid username, alphanumeric & longer than or equals 5 chars
            $valid = false;
            $usernameValid = false;
            $errorMsg = "Username must be at least 5 characters in length and only contain alphanumerical characters";
            $this->userError($errorMsg);
        }
    
        if($usernameValid == true){
            $userObj = $this->SqlHandler->getUser($username);
            // check if username exits
            if($userObj == false){
                $valid = false;
                $errorMsg = "Invalid Credentials";
                $this->userError($errorMsg);
            }
            // if username exits check if passwords match
            else if(password_verify($password,$userObj->HashedPassword) != 1){
                $valid = false;
                $errorMsg = "Invalid Credentials";
                $this->userError($errorMsg);
            }
        }
        
        if($valid == true){
            echo "## VALID LOGIN ##";
            $this->loggedInUsername = $username;
            $this->currentView = "ItemsTableView";
            gotoView("/Home");
        }        
        else{
            gotoView("/login");
        }
        echo "<br><h1>".$username."  ".$password."<br></h1>";       
    }
   
    
    private function forgotPasswordClicked($data){
        $this->currentView = "ForgotPassword";
    }
    
    
    private function emailSubmitForPasswordReset($data){
        $email = $data["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "You entered an invalid email!";
            $this->userError($errorMsg);
        }
        else{
            //generate new entry in forgotpassword table
            //send email
            if($this->SqlHandler->getUserByEmail($email) != false){
                // user exits
                $code = SecureRandom::getToken(6);
                $this->Mailer->sendPasswordResetCodeEmail($code, $email);
                $this->passwordResetCode = $code;
                $this->emailUsed = $email;
                $this->currentView = "ResetCodeView";
            }
            else{
                $errorMsg = "No account is registered to this email!s";
                $this->userError($errorMsg);
            }
            
        }
    }
    
    private function resetCodeEntered($data){
        $enteredResetcode = $data["resetCode"];
        if($enteredResetcode == $this->passwordResetCode){
            $this->currentView = "ResetPasswordView";           
        }
        else{
            $errorMsg = "Invalid Reset Code";
            $this->userError($errorMsg);
        }
        
    }
    
    private function newPasswordEntered($data){
        $password = $data["password"];
        $confirmPassword = $data["password2"];
        $email = $this->emailUsed;
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
            $errorMsg = "Password should be at least 6 characters in length and should include at least one upper case letter and one number!";
            $this->userError($errorMsg);
        }
        else if($password != $confirmPassword){
            $errorMsg = "Passwords dont match!";
            $this->userError($errorMsg);
        }
        else{
            // update password - not gonna be loged in 
            $userID = $this->SqlHandler->getUserByEmail($email)->UserID;
            $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
            $this->SqlHandler->updateUserPassword($userID, $hashedPassword);
            echo "PASSWORD RESET!!!!!";
        }
        
    }
    
    
    
    
    private function registerationAttempt($data){
        echo "registration attempted";           
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];
        $passwordConfirm = $data["password2"];
        
        $valid = true;   
        $usernameValid = true;
        $emailValid = true;
        
        if(!(preg_match('/^[a-zA-Z0-9]{5,}$/', $username))) { // for english chars + numbers only
            // valid username, alphanumeric & longer than or equals 5 chars
            $valid = false;
            $usernameValid = false;
            $errorMsg = "Username must be atleast 5 at least 6 characters in length ";
            $this->userError($errorMsg);
        }                    
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {                  
            $valid = false;
            $errorMsg = "Password should be at least 6 characters in length and should include at least one upper case letter and one number!";
            $this->userError($errorMsg);                  
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $emailValid = false;
            $errorMsg = "You entered an invalid email!";
            $this->userError($errorMsg);  
        }
        if(!($password === $passwordConfirm)){
            $valid = false;
            $errorMsg = "Your passwords dont match!";
            $this->userError($errorMsg); 
        }
        if(($usernameValid == true)&& (($this->SqlHandler->getUser($username) != false))){
            $valid = false;
            $errorMsg = "That username is already taken!";
            $this->userError($errorMsg); 
        }
        if(($emailValid == true) && (($this->SqlHandler->getUserByEmail($email) != false))){
            $valid = false;
            $errorMsg = "That email is already linked to another account!";
            $this->userError($errorMsg); 
        }
        if($valid == true){
            echo "VALID REG !";
            $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
            $this->SqlHandler->insertUser($username, $email, $hashedPassword);
            // lead to home page
        }
        
    }
    
    
    
    private function itemRequested($data){
        $requestDesc = $data["request"];
        $itemID = $data["itemID"];
        
        if(strlen($requestDesc)>=1000) { // for english chars + numbers only
            $errorMsg = "description must be less than 1000 characters";
            $this->userError($errorMsg);
            gotoView("/Request_item");
        }
        else{
            $userID = $this->SqlHandler->getUser($this->loggedInUsername)->UserID;
            $this->SqlHandler->insertRequest($requestDesc, $itemID, $userID);
            gotoView("/Home");
        }
        
          
    }
    
    
    private $lastAddedItemID;
    
    private function addItem($data){
        $category = $data["Category"];
        $name = $data["name"];
        $colour = $data["colour"];
        $location = $data["location"];
        $date = $data["date"];
        $description = $data["description"];
        $valid = true;
        
        $dateEx = explode("-", $date);
        $year = $dateEx[0];
        $month = $dateEx[1];
        $day = $dateEx[2];
        
        echo print_r($dateEx);
        if(!(preg_match('/^[a-zA-Z0-9 .]{3,}$/', $name))) { // for english chars + numbers only
            // valid item name, alphanumeric & longer than or equals 3 chars
            $valid = false;
            $errorMsg = "item name must be at least 3 characters in length and only use numbers and letters";
            $this->userError($errorMsg);
        }
        else if(!(preg_match('/^[a-zA-Z ]{3,}$/', $colour))) { // for english chars + numbers only
            // valid item colour, alphanumeric & longer than or equals 3 chars
            $valid = false;
            $errorMsg = "item colour must be at least 3 characters in length and only use letters";
            $this->userError($errorMsg);
        }
        else if(!(preg_match('/^[a-zA-Z0-9 ]{3,}$/', $location))) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "item location must be at least 5 characters in length and only use numbers and letters";
            $this->userError($errorMsg);
        }
        else if(strlen($description)>=1000) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "description must be less than 1000 characters";
            $this->userError($errorMsg);
        }
        else if(checkdate($month,$day,$year) == false) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "invalid date entered! $month,$day,$year";
            $this->userError($errorMsg);
        }
        if($valid == true){
            $this ->lastAddedItemID =  $this->SqlHandler->addItem(array("name"=>$name,"colour"=>$colour,
                "location"=>$location,"date"=>$date,"category"=>$category,"desc"=>$description
            ));
            $this->currentView = "AddItemDetailsView";
            gotoView("/add_item_photos");
        }
        else{
            gotoView("/Add_item_details");
        }
        
    }
    
    private function itemPhotosUploadRequest($data){
        echo $data;
        // SRROUND WITH TRY CATCH
        $path = "C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages";
        $itemID = $this->lastAddedItemID;;
        $allImgs = $_FILES[$data];
        $imgCount = count($allImgs["name"]);
        $valid = true;
        $imgTypes = array("jpeg","jpg","png");
        // validation in this loop
        if($imgCount>10){
            $valid = false;
            $errorMsg = "maximum of 10 image allowed";
            $this->userError($errorMsg);
        }
        for($i=0; $i<$imgCount && $valid == true; $i++){
            $name = $allImgs["name"][$i];
            $type = strtolower(pathinfo($name)["extension"]);
            $size = $allImgs["size"][$i];
            if(in_array($type, $imgTypes) == false){
                $valid = false;
                $errorMsg = "a file was not of type png or jpeg";
                $this->userError($errorMsg);
            }
            
            echo "<br>type = $type<br>";
            echo "size = $size<br>";
        }
        if($valid == true){
            mkdir($path."\\".$itemID);
            for($i=0; $i<$imgCount; $i++){
                $errorMsg = "immage count = $imgCount";
                $this->userError($errorMsg);
                $temp_name = $allImgs["tmp_name"][$i];
                $type = pathinfo($name)["extension"];
                $destination = $path."\\".$itemID."\\".$i.".".$type;
                move_uploaded_file($temp_name, $destination);
                
            }
            gotoView("/Home");
            $this->currentView = "AddItemPhotosView";
        }
        else{
            
            gotoView("/add_item_photos");
        }
        
        
    }
    
    

    
    
    
    
    
    private function itemCategorySelected($data){
        $category = $data["Category"];
        $this ->dataPassedToView["Category"] = $category;
        $this->currentView = "AddItemDetailsView";
        gotoView("/add_item_details");
    }
    
    private function addFoundItemClicked($data){       
        $this->currentView = "SelectItemCategoryView";
    } 
    
//     private function requestItemClicked($data){
//         echo "yee - "+ print_r($data);
//        // $username = $data['username'];
//         $itemID  = $data['itemID'];
//        // $username ="admin"; 
//         $queryResult = $this->SqlHandler->getItem($itemID);
//         $item = $queryResult["item"];
//         $this->dataPassedToView['item'] = $item;
//         $this->currentView = "RequestItemView";
//         gotoView("/Request_item");
//         //$this->c
//     }
    
    
    private function itemRowClicked($itemID){
        echo "data passed = ".print_r($itemID)."  x= ".$itemID;
      
      $queryResult = $this->SqlHandler->getItem($itemID);
      $item = $queryResult["item"];
      $foundByUser = $queryResult["user"];     
      // add validation !
      $this->dataPassedToView['item'] = $item;
      $this->dataPassedToView['user'] = $foundByUser;     
      $this -> currentView = "ItemDetailsView";
    }
    
  
    

    
    private function loginButtonClicked(){
        echo"login called called";
        $this -> currentView = "LoginView"; 
    }
    
    
    private function registerButtonClicked(){
        echo"reg called";
        $this -> currentView = "RegisterView";       
    }
    
    private function guestButtonClicked(){
        echo"guest called";
        $this -> currentView = "ItemsTableView";    
    }
    
    
    private function tableViewLoginClicked(){
        $this -> currentView = "IntroScreenView";  
    }
    
    private function logoutClicked(){
        unset($this->loggedInUsername);
        $this -> currentView = "IntroScreenView";  
    }
    
    
    private function backButtonClicked(){
        echo"back called";
        $v1 = array("ItemsTableView","RegisterView","LoginView");
        $v2 = array("ItemDetailsView","SelectItemCategoryView","RequestItemView");
        if(in_array($this->currentView,$v1)){
            $this -> currentView = "IntroScreenView";
        }       
        if(in_array($this->currentView,$v2)){
            $this -> currentView = "ItemsTableView";
        }
        else{
            $this -> currentView = "IntroScreenView";
        }
       
    }
    
    
    
    
    
    
    private function userError($error){
        $msg = "<br>* $error <br>";
        if(isset($this->dataPassedToView["error"])){
            $this->dataPassedToView["error"] = $this->dataPassedToView["error"] . $msg;
        }
        else{
            $this->dataPassedToView["error"] =$msg;
        }
        echo "<br><h2>error! - $error</h2><br>";
    }
    
    private function serverError($error){
        // kead to error page
    }
    
}
?>