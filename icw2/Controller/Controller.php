<?php
include_once "View/View.php";
include_once 'Controller/SqlHandler.php';

session_start();
class  Controller{
    
    
    public $SqlHandler;
    
    public $views; 
    public $pointer;
    
    private $currentView;    
    private $dataPassedToView;
    
    public function __construct(){
        $viewNames = array("IntroScreenView","ItemsTableView"
            ,"RegisterView","LoginView","ItemDetailsView","AddItemDetailsView"
            ,"RequestItemView","AddItemPhotosView","SelectItemCategoryView");
        
        foreach($viewNames as $viewName){
            $view = new $viewName();
            $this->views[$viewName] = $view;
        };
        
        $this -> SqlHandler = new SqlHandler();
    }
    
    
    
    public function invoke($method,$data){
        echo "<h2>method called = $method<br>
       data passed = ".print_r($data)."  </h3> ";

        $this->dataPassedToView = array();
        
        if($method == null){
            $this->default();
        }
        else if(is_callable(array('Controller', $method))){
            $this->$method($data);
        }
        else{
            $this->Error("method $method not found");
        }
        $this->DisplayView();
        $this->saveState();  
        echo "<br>current view = ".$this -> currentView."<br>";
    }
    
 
    private function default(){
        echo"default called";
        $this -> currentView = "IntroScreenView"; 
    }
    
    private function saveState(){
        $_SESSION['Controller'] = serialize($this);
    }
    
    
    
    
    private function DisplayView(){
        $method_name = "Display".$this->currentView;   
        if(is_callable(array('Controller', $method_name))){
            $this->$method_name();
        }
        else{    
            $this->views[$this->currentView]->draw($this->dataPassedToView);
        }
        
    }
    
    private function DisplayIntroScreenView(){
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    private function DisplayItemsTableView(){
        $countIndex = 0;
        if(isset($this->dataPassedToView['countIndex'])){
            $countIndex = $this->dataPassedToView['countIndex'];
        }
        
        echo "count index ## = ".$countIndex;
        $allItems = $this->SqlHandler->getAllItems(5,$countIndex); 
        // do validation for query result ! 5 max
        $this -> dataPassedToView["queryResult"] = $allItems;
        $this->views[$this->currentView]->draw($this->dataPassedToView);
    }
    
    
    
    
    
    
    
    
    
    
    
    private function loginAttempt($data){
        echo "loggin attempted";
        $username = $data["username"];
        $password  = $data ["password"];
        echo "<br><h1>".$username."  ".$password."<br></h1>";       
    }
   
    
    private function registerationAttempt($data){
        echo "registration attempted";
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];
        $passwordConfirm = $data["password2"];
        
    }
    
    
    
    
    
   // private $c;
    private function uploadImageClicked($data){
     
        
        $name = $_FILES[$fileName]["name"];
        $temp =$_FILES[$fileName]["tmp_name"];
        echo " cx  ".print_r($_FILES[$fileName]);
        echo " <br>size  ".$_FILES[$fileName]["size"];
        $destination = "./UploadedImages/".$name;
        $dest2 =  dirname(__FILE__) . "\UploadedImages\\" . $name;
        $path="C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages\\".$name;
        echo " <br>size  ".$dest2."<br>";
        move_uploaded_file($temp, $path);
       // copy($temp, $destination);
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
            $this -> currentView = "ItemsTableView";
        }
       
    }
    
    
    
    
    
    
    private function Error($error){
        echo "<br><h2>error! - $error</h2><br>";
        $this->dataPassedToView["error"] = $error;
    }
    
    
    
}
?>