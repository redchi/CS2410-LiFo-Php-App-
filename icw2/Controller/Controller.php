<?php
/*
* CS2410 Internet Applications and Techniques Coursework
* Aston University - Asim Younas - 180050734 - April 2020
*
*/


include_once "View/View.php";
include_once 'Controller/SqlHandler.php';
include_once 'Controller/SecureRandom.php';
include_once "Controller/Mailer.php";


/*
 * 
 * Controlls the flow of data
 * has methods for displaying views
 * all user interactions in system 
 * and log in/out systems
 * 
 */
class  Controller{
    
    // all views used by website as assoc array
    private $views;
    
    // current view being rendered
    private $currentView;
    
    // data to be passed to next view to be drawn
    private $dataPassedToView;
    
    //username of loged in user
    private $loggedInUsername;
  
    //object for handling all sql
    private $SqlHandler;
    
    // object for sending emails
    private $Mailer;  
    
    // the password reset code generated
    private $passwordResetCode;
    
    // email used for password reset
    private $emailUsed;
  
    /*
     * Contructor, makes all the views as object
     */
    public function __construct(){
        $viewNames = array("IntroScreenView","ItemsTableView"
            ,"RegisterView","LoginView","ItemDetailsView","AddItemDetailsView"
            ,"RequestItemView","AddItemPhotosView","SelectItemCategoryView"
            ,"ForgotPassword","ResetCodeView","ResetPasswordView","AllRequestsView"
            ,"RequestDetailsView","HomeView","ErrorView"
        );
        
        foreach($viewNames as $viewName){
            $view = new $viewName();
            $this->views[$viewName] = $view;
        };
        $this->Mailer = new Mailer();
        $this -> SqlHandler = new SqlHandler();
    }
    /*
     * states if user is signed in
     */
    public function isUserSignedIn(){
        return (!empty($this->loggedInUsername));
    }
    
    /*
     * states if signed in user is admin or not
     */
    public function isUserAdmin(){
        return ($this->isUserSignedIn() == true && $this->loggedInUsername =="admin");
    }
    
    /*
     * called by index.php to display a certain view based on URL
     */
    public function displayView($viewName,$viewParams = array()){   
        try {
            // call a success/error/progress handler
            $this->dataPassedToView["userLoggedIn"] = $this->isUserSignedIn();
            $this->dataPassedToView["adminLoggedIn"] = $this->isUserAdmin();
            $method_name = "Display".$viewName;
            $this->dataPassedToView['loggedInUsername'] = $this->loggedInUsername;
            if(is_callable(array('Controller', $method_name))){
                $this->$method_name($viewParams);
            }
            else{
                $this->views[$viewName]->draw($this->dataPassedToView);
            }
            
            $this->currentView = $viewName;
            $this->dataPassedToView = array();
            $this->saveState();  
            
            
        } catch (\Exception $e) { // For PHP 5
            gotoView("/Error");
        }
    
    }
    
    /*
     * Called by index.php when a User interaction occurs
     * calls the method specified and passes the data it needs
     */
    
    public function UserInteractionHandle($method,$data){
       if(is_callable(array('Controller', $method))){
            $this->$method($data);
        }
        else{
            gotoView("/Error");
        }
        $this->saveState();  
    }
    
    /*
     *called by index.php when /logout is in URL
     *logs out user 
     */
    public function logout(){
        unset($this->loggedInUsername);
        gotoView("/Home");
    }
    
    /*
     * save the state of this controller object in session
     * by serializing it 
     */
    private function saveState(){
        $_SESSION['Controller'] = serialize($this);
    }
    

    /*
     *  ** DISPLAY METHODS ** - methods called when drawing a specific view 
     * unlike other views these need to query database for data needed to display view
     * so they need their individual methods
     * are called by displayView method
     */
    
    /*
     * displays all items View
     * querys database for all items in item table 
     */
    private function DisplayItemsTableView(){
        $allItems = $this->SqlHandler->getAllItems(); 
        $this -> dataPassedToView["queryResult"] = $allItems;
        $this->views["ItemsTableView"]->draw($this->dataPassedToView);
    }
    
    /*
     * displays all request view
     * querys database for all requests
     */
    private function DisplayAllRequestsView(){
        
        $allObjs = $this->SqlHandler->getAllRequests();
        $this -> dataPassedToView["queryResult"] = $allObjs;
        $this->currentView =  "AllRequestsView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    /*
     * displays a specific item details
     * params = itemID
     * querys database for item PDO object
     */
    private function DisplayItemDetailsView($params){
        $itemID = $params["itemID"];       
        $queryResult = $this->SqlHandler->getItem($itemID);
        $item = $queryResult["item"];
        $foundByUser = $queryResult["user"];
        if(empty($item)){
            throw new Exception('item not found');
        }
        $this->dataPassedToView['item'] = $item;
        $this->dataPassedToView['user'] = $foundByUser;
        $this -> currentView = "ItemDetailsView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    /*
     * Displays view for requesting an item
     * params = itemID
     */
    private function DisplayRequestItemView($data){
        $itemID  = $data['itemID'];
        $queryResult = $this->SqlHandler->getItem($itemID);
        $item = $queryResult["item"];
        if(isset($item->Name) == false){
            throw new Exception('item  not found');
        }
        $this->dataPassedToView['item'] = $item;
        $this->currentView = "RequestItemView";
        $this->views[$this->currentView]->draw($this->dataPassedToView);
        
    }
    
    /*
     * Displays a item Request view for admin
     * params = requestID
     */
    private function DisplayRequestDetailsView($data){
        $requestID  = $data['requestID'];
        $this->currentView = "RequestDetailsView";
        $resultObjs = $this->SqlHandler->getRequestAndRelatedObjs($requestID);
        if(isset($resultObjs["request"]) == false){
            throw new Exception('item request not found');
        }
        $this->dataPassedToView["request"] = $resultObjs;
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    
    
    /*
     * ** USER INTERACTION METHODS ** - methods called when there is a user interaction.
     * can be anything from pressing a approve request button to adding a new item
     * data is passed by index.php
     * 
     */

 
    /*
     * called when admin approves a request
     * deletes request from request table
     * deletes that item from item table
     * deletes its photos from server
     * and send email to person that requested the item 
     * pramas = requestID
     */
    private function approveRequest($RID){
     
        $resultObjs = $this->SqlHandler->getRequestAndRelatedObjs($RID);
      
        if(isset($resultObjs["item"])){
            $item = $resultObjs["item"];
            $user = $resultObjs["user"];
            $itemID =$item->ItemID;
            $email = $user->Email;
            $this->SqlHandler->deleteRequestAndRelatedObjs($RID, $itemID);
            // send email
            $this->Mailer->sendRequrestApprovedEmail($item, $email);
            
            $dirname =IMG_FOLDER."/".$itemID;
            if(file_exists($dirname)){
                array_map('unlink', glob("$dirname/*.*"));
                rmdir($dirname); 
            }
            $msg = "request sucessfully approved";
            $this->popUpMsg($msg);
            gotoView("/Home");
            
        }
        else{
            gotoView("/Error");
        }
    }
    
    /*
     * denys a request for a item
     * deletes that request from requests table
     * send email to user that there request has been denied 
     * 
     */
    private function denyRequest($RID){
        $resultObjs  = $this->SqlHandler->getRequestAndRelatedObjs($RID);
        if(isset($resultObjs["user"]->UserID)){
            $item = $resultObjs["item"];
            $user = $resultObjs["user"];        
            $email = $user->Email;
            $this->SqlHandler->deleteRequest($RID);
            $this->Mailer->sendRequrestDeniedEmail($item, $email);
            $msg = "request sucessfully denied";
            $this->popUpMsg($msg);
            gotoView("/Home");
        }
        else{
            gotoView("/Error");
        }
        
        
    }
    
 
    /*
     * attempt to login to server, called when login form is submitted
     * checks if usernameis only alpha numerical and tryes to get that username from users table
     * if it is found then compares the hashed password with submitted password
     * if they match aswell then it loggs in th user 
     * params = username,password
     */
    
    private function loginAttempt($data){
        $username = strtolower($data["username"]);
        $password  = $data ["password"];
        $valid = true;
        $usernameValid = true;
        if(!(preg_match('/^[a-zA-Z0-9]{5,}$/', $username))) { // for english chars + numbers only
            $valid = false;
            $usernameValid = false;
            $errorMsg = "Username must be at least 5 characters in length and only contain alphanumerical characters";
            $this->popUpMsg($errorMsg);
        }
    
        if($usernameValid == true){
            $userObj = $this->SqlHandler->getUser($username);
            if($userObj == false){
                $valid = false;
                $errorMsg = "Invalid Credentials";
                $this->popUpMsg($errorMsg);
            }
            else if(password_verify($password,$userObj->HashedPassword) != 1){
                $valid = false;
                $errorMsg = "Invalid Credentials";
                $this->popUpMsg($errorMsg);
            }
        }
        
        if($valid == true){
            $this->loggedInUsername = $username;
            $this->currentView = "ItemsTableView";
            gotoView("/Home");
        }        
        else{
            gotoView("/login");
        }
    }
   

    /*
     * called when email is submitted for password reset
     * checks if that email is linked to a user
     * if so then email that user a password reset code
     * 
     */
    
    private function emailSubmitForPasswordReset($data){
        $email = $data["email"];
        $valid = true;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $errorMsg = "You entered an invalid email!";
            $this->popUpMsg($errorMsg);
        }
        else if($this->SqlHandler->getUserByEmail($email) == false){
            $valid = false;
            $errorMsg = "No account is registered to this email!s";
            $this->popUpMsg($errorMsg);
        }
        
        if($valid == true){
            $code = SecureRandom::getToken(6);
            $this->Mailer->sendPasswordResetCodeEmail($code, $email);
            $this->passwordResetCode = $code;
            $this->emailUsed = $email;
            gotoView("/reset_code_enter");
        }
        else{
            gotoView("/forgot_password");
        }              
    }
    
    /*
     * called when a reset code is entered checks if that code 
     * matches the one stored in controller if so then password can be reset
     * params = reset code
     */
    private function resetCodeEntered($data){
        $enteredResetcode = $data["resetCode"];
        if($enteredResetcode == $this->passwordResetCode){
            $this->currentView = "reset_code_enter";
            gotoView("/reset_password");
            
        }
        else{
            $errorMsg = "Invalid Reset Code";
            $this->popUpMsg($errorMsg);
            gotoView("/reset_code_enter");
        }
        
    }
    
    /*
     *called when resey code is correct
     *enables user to reset there password
     *and updates the  users table for new hashed password
     *params = new password 
     */
    private function newPasswordEntered($data){
        $password = $data["password"];
        $confirmPassword = $data["password2"];
        $email = $this->emailUsed;
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        $valid = true;
        
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
            $errorMsg = "Password should be at least 6 characters in length and should include at least one upper case letter and one number!";
            $this->popUpMsg($errorMsg);
            $valid = false;
        }
        else if($password != $confirmPassword){
            $errorMsg = "Passwords dont match!";
            $this->popUpMsg($errorMsg);
            $valid = false;
        }
        if (  $valid == true){
            // update password - not gonna be loged in 
            $userID = $this->SqlHandler->getUserByEmail($email)->UserID;
            $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
            $this->SqlHandler->updateUserPassword($userID, $hashedPassword);
            gotoView("/Home");
        }
        else{
            gotoView("/reset_password");
        }
        
    }
    
    
    /*
     * called when a user trys to register a new account
     * validates the fields and then inserts a new value into users table
     * params = username, email, password, confirm password
     */
    private function registerationAttempt($data){
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
            $errorMsg = "Username must be at least 5 characters in length ";
            $this->popUpMsg($errorMsg);
        }                    
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {                  
            $valid = false;
            $errorMsg = "Password should be at least 6 characters in length and should include at least one upper case letter and one number!";
            $this->popUpMsg($errorMsg);                  
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $emailValid = false;
            $errorMsg = "You entered an invalid email!";
            $this->popUpMsg($errorMsg);  
        }
        if(!($password === $passwordConfirm)){
            $valid = false;
            $errorMsg = "Your passwords dont match!";
            $this->popUpMsg($errorMsg); 
        }
        if(($usernameValid == true)&& (($this->SqlHandler->getUser($username) != false))){
            $valid = false;
            $errorMsg = "That username is already taken!";
            $this->popUpMsg($errorMsg); 
        }
        if(($emailValid == true) && (($this->SqlHandler->getUserByEmail($email) != false))){
            $valid = false;
            $errorMsg = "That email is already linked to another account!";
            $this->popUpMsg($errorMsg); 
        }
        if($valid == true){
           // echo "VALID REG !";
            $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
            $this->SqlHandler->insertUser($username, $email, $hashedPassword);
            $msg = "Sucessfully registered!";
            $this->popUpMsg($msg);
            gotoView("/Login");
            // lead to home page
        }
        else{
            gotoView("/Register");
        }
        
    }
    
    
    /*
     *called when user requests an item
     *params = request reason, item ID 
     */
    private function itemRequested($data){
        $requestDesc = $data["request"];
        $itemID = $data["itemID"];
        
        if(strlen($requestDesc)>=1000) { // for english chars + numbers only
            $errorMsg = "description must be less than 1000 characters";
            $this->popUpMsg($errorMsg);
            gotoView("/Request_item");
        }
        else{
            $Msg = "request made";
            $this->popUpMsg($Msg);
            $userID = $this->SqlHandler->getUser($this->loggedInUsername)->UserID;
            $this->SqlHandler->insertRequest($requestDesc, $itemID, $userID);
            gotoView("/Home");
        }
        
          
    }
    
    //stores the last item ID added into the items table
    private $lastAddedItemID;
    
    /*
     * called when user trys to add a new item into the database
     * validates input fields, then insert new item into items table
     * pramas = item cateogry, item name, colour, Location, datefound, description 
     */
    private function addItem($data){
        
        $category = $data["Category"];                
        // check if category is correct
        $cats = array("pet","phone","jewellery");
        if(in_array($category, $cats) == false){
            $valid = false;
            $errorMsg = "Error trying to add a non existant category?
                          Please select a valid category";
            $this->popUpMsg($errorMsg);
            gotoView("/add_item_category");
        }
        
        $name = $data["name"];
        $colour = $data["colour"];
        $location = $data["location"];
        $date = $data["date_found"];
        $description = $data["description"];
        $valid = true;
        
        $dateEx = explode("-", $date);
        $year = $dateEx[0];
        $month = $dateEx[1];
        $day = $dateEx[2];
        
        if(!(preg_match('/^[a-zA-Z0-9 .]{3,}$/', $name))) { // for english chars + numbers only
            // valid item name, alphanumeric & longer than or equals 3 chars
            $valid = false;
            $errorMsg = "item name must be at least 3 characters in length and only use numbers and letters";
            $this->popUpMsg($errorMsg);
        }
        else if(!(preg_match('/^[a-zA-Z ]{3,}$/', $colour))) { // for english chars + numbers only
            // valid item colour, alphanumeric & longer than or equals 3 chars
            $valid = false;
            $errorMsg = "item colour must be at least 3 characters in length and only use letters";
            $this->popUpMsg($errorMsg);
        }
        else if(!(preg_match('/^[a-zA-Z0-9 ]{3,}$/', $location))) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "item location must be at least 5 characters in length and only use numbers and letters";
            $this->popUpMsg($errorMsg);
        }
        else if(strlen($description)>=1000) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "description must be less than 1000 characters";
            $this->popUpMsg($errorMsg);
        }
        else if(checkdate($month,$day,$year) == false) { // for english chars + numbers only
            $valid = false;
            $errorMsg = "invalid date entered! $month,$day,$year";
            $this->popUpMsg($errorMsg);
        }
        if($valid == true){
            $userID = $this->SqlHandler->getUser($this->loggedInUsername)->UserID;
            $this ->lastAddedItemID =  $this->SqlHandler->addItem(array("name"=>$name,"colour"=>$colour,
                "location"=>$location,"date"=>$date,"category"=>$category,"desc"=>$description
            ),$userID);
            $this->currentView = "AddItemDetailsView";
            $msg = "item sucessfully added!";
            $this->popUpMsg($msg);
            gotoView("/add_item_photos");
        }
        else{
            gotoView("/Add_item_details");
        }       
        
    }
    
    /*
     * called when user trys to upload photos for recently added item
     * validates all incomming files
     * checks type and amount of files
     * then makes a new directory in /UploadedImages based on itemID
     * then adds files to this directory
     * 
     */
    private function itemPhotosUploadRequest($data){
        $path = IMG_FOLDER;
        if(file_exists(IMG_FOLDER)){
            echo "DIR EXITSS !";
        }
        else{
            echo "NOPE :(";
        }
        die();
        $itemID = $this->lastAddedItemID;;
        $allImgs = $_FILES[$data];
        $imgCount = count($allImgs["name"]);
        $valid = true;
        $imgTypes = array("jpeg","jpg","png");
     
        if($imgCount>10){
            $valid = false;
            $errorMsg = "maximum of 10 image allowed";
            $this->popUpMsg($errorMsg);
        }
        for($i=0; $i<$imgCount && $valid == true; $i++){
            $name = $allImgs["name"][$i];
            $type = strtolower(pathinfo($name)["extension"]);
            if(in_array($type, $imgTypes) == false){
                $valid = false;
                $errorMsg = "a file was not of type png or jpeg";
                $this->popUpMsg($errorMsg);
            }
        }
        if($valid == true){
            mkdir($path."/".$itemID);
            for($i=0; $i<$imgCount; $i++){
                $errorMsg = "immage count = $imgCount";
                $this->popUpMsg($errorMsg);
                $temp_name = $allImgs["tmp_name"][$i];
                $type = pathinfo($name)["extension"];
                $destination = $path."/".$itemID."/".$i.".".$type;
                move_uploaded_file($temp_name, $destination);
                
            }
            $this->currentView = "AddItemPhotosView";

            gotoView("/Home");
        
        }
        else{
            gotoView("/add_item_photos");
        }
        
        
    }
    
    /*
     *called when item category is selected 
     * params = category
     */
    private function itemCategorySelected($data){
        $category = $data;
        $this ->dataPassedToView["Category"] = $category;
        $this->currentView = "AddItemDetailsView";
        gotoView("/add_item_details");
    }
    
     /*
      * passes a string/msg to view that will be poped up
      * when the next view is loaded
      */
    private function popUpMsg($error){
        $msg = "<br>* $error <br>";
        if(isset($this->dataPassedToView["error"])){
            $this->dataPassedToView["error"] = $this->dataPassedToView["error"] . $msg;
        }
        else{
            $this->dataPassedToView["error"] =$msg;
        }
     }
    
  
}
?>