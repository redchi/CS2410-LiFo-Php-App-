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
    private $loggedInUsername;
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
        return ($this->isUserSignedIn == true && $this->loggedInUsername =="admin");
    }
    
    
    public function displayView($viewName,$viewParams = array()){
        echo " display view called $viewName ";
        $method_name = "Display".$viewName;
        
        if(is_callable(array('Controller', $method_name))){
            echo "##x1";
            $this->$method_name();
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
        $this->views[IntroScreenView]->draw($this->dataPassedToView);
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
        $countIndex = 0;
        if(isset($this->dataPassedToView['countIndex'])){
            $countIndex = $this->dataPassedToView['countIndex'];
        }
        
        echo "count index ## = ".$countIndex;
        $allObjs = $this->SqlHandler->getAllRequests(5,$countIndex);
        // do validation for query result ! 5 max
        $this -> dataPassedToView["queryResult"] = $allObjs;
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    
    
    
    
//     private function goto($relativePath){
//        $path =  "./$relativePath";
//        header('Location: '.$path);
//        exit;
//     }
    
 
    
    private function approveRequest($RID){
        
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
    
    private function nextPageOnRTableClicked($countIndex){
        $itemCountIndex = (int)$countIndex;
        echo "next item page called $itemCountIndex ";
        
        $maxCount = $this->SqlHandler->getAllRequestsCount();
        $setIndex = $itemCountIndex;
        
        if($maxCount - ($itemCountIndex+5)>0){
            $setIndex = $setIndex + 5;
        }
        
        $this->dataPassedToView['countIndex'] = $setIndex;
      //  $this->currentView = "ItemsTableView";
        echo "<br>###current view = ".$this -> currentView."<br>";      
    }
    
    private function prevPageOnRTableClicked($countIndex){
        $itemCountIndex = (int)$countIndex;
        echo "prev item page called $itemCountIndex ";
        
        // $maxCount = $this->SqlHandler->getAllItemsCount();
        $setIndex = $itemCountIndex;
        if($itemCountIndex - 5>=0){
            $setIndex = $setIndex - 5;
        }
        $this->dataPassedToView['countIndex'] = $setIndex;
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
    
    
    
    private function requestClicked($data){
        $requestDesc = $data["request"];
        $itemID = $data["itemID"];
        $userID = $this->SqlHandler->getUser($this->loggedInUsername)->UserID;
        $this->SqlHandler->insertRequest($requestDesc, $itemID, $userID);
        echo "request processed yee yee!";        
    }
    
    
  
    
    
    private $lastAddedItemID;
    
    private function addItem($data){
        $category = $data["Category"];
        $name = $data["name"];
        $colour = $data["colour"];
        $location = $data["location"];
        $date = $data["date"];
        $description = $data["description"];
        // validate then add to data base
        $this ->lastAddedItemID =  $this->SqlHandler->addItem(array("name"=>$name,"colour"=>$colour,
            "location"=>$location,"date"=>$date,"category"=>$category,"desc"=>$description 
        ));
        
        $this->currentView = "AddItemPhotosView";
        // validation here!AddItemPhotosView
    }
    
    private function itemPhotosUploadRequest($data){
        echo $data;
       $path = "C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages";
        $itemID = $this->lastAddedItemID;;
        $allImgs = $_FILES[$data];
        $imgCount = count($allImgs["name"]);
        valid = true;
        // validation in this loop
        for($i=0; $i<$imgCount; $i++){
            $name = $allImgs["name"][$i];    
            $type = pathinfo($name)["extension"];
            
            
        }
        
        mkdir($path."\\".$itemID);
        for($i=0; $i<$imgCount; $i++){
            $temp_name = $allImgs["tmp_name"][$i];
            $type = pathinfo($name)["extension"];        
            $destination = $path."\\".$itemID."\\".$i.".".$type;
            move_uploaded_file($temp_name, $destination);
        }
        
        
        $this->photosToBeuploaded = $allImgs;
     //   $this ->dataPassedToView["Category"] = $category;
        $this->currentView = "AddItemDetailsView";
    }
    
    
    private function uploadPhotos(){
        echo "upload photos called ";
        $allImgs = $this->photosToBeuploaded;
        $path = "C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages";
        $imgCount = count($allImgs["name"]);
        for($i=0; $i<$imgCount; $i++){
            $name = $allImgs["name"][$i];
            echo "<br> name = ".$name;
            $temp_name = $allImgs["tmp_name"][$i];
            $destination = $path."\\".$name;
            move_uploaded_file($temp_name, $destination);
        }  
  
    }
    
    
    
    
    
    private function itemCategorySelected($data){
        $category = $data["Category"];
        $this ->dataPassedToView["Category"] = $category;
        $this->currentView = "AddItemDetailsView";
    }
    
    private function addFoundItemClicked($data){       
        $this->currentView = "SelectItemCategoryView";
    } 
    
    private function requestItemClicked($data){
        echo "yee - "+ print_r($data);
       // $username = $data['username'];
        $itemID  = $data['itemID'];
       // $username ="admin"; 
        $queryResult = $this->SqlHandler->getItem($itemID);
        $item = $queryResult["item"];
        $this->dataPassedToView['item'] = $item;
        $this->currentView = "RequestItemView";
        //$this->c
    }
    
    
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
    
    private function nextItemPageClicked($countIndex){
        $itemCountIndex = (int)$countIndex;
        echo "next item page called $itemCountIndex ";
        
        $maxCount = $this->SqlHandler->getAllItemsCount();
        $setIndex = $itemCountIndex;
        if($maxCount - ($itemCountIndex+5)>0){
            $setIndex = $setIndex + 5;
        }
        $this->dataPassedToView['countIndex'] = $setIndex;
        $this->currentView = "ItemsTableView";
        echo "<br>###current view = ".$this -> currentView."<br>";
    }
    
    private function previousItemPageClicked($countIndex){
        $itemCountIndex = (int)$countIndex;
        echo "prev item page called $itemCountIndex ";
        
       // $maxCount = $this->SqlHandler->getAllItemsCount();
        $setIndex = $itemCountIndex;
        if($itemCountIndex - 5>=0){
            $setIndex = $setIndex - 5;
        }
        $this->dataPassedToView['countIndex'] = $setIndex;
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