<?php
include_once "View/View.php";
include_once 'Controller/SqlHandler.php';

session_start();
class  Controller{
    
    
    public $SqlHandler;
    
    
    public  $views; 
    public $pointer;
    
    
    
    private $currentView;    
    private $dataPassedToView;
    
    public function __construct(){
        $viewNames = array("IntroScreenView","ItemsTableView"
            ,"RegisterView","LoginView");
        
        foreach($viewNames as $viewName){
            $view = new $viewName();
            $this->views[$viewName] = $view;
        };
        
        $this -> SqlHandler = new SqlHandler();
    }
    
    
    
    public function invoke($method,$data){
        echo "<h2>method called = $method</h2><br>";

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
        $allItems = $this->SqlHandler->getAllItems($countIndex,$countIndex + 5); 
        
        
        
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
        if(in_array($this->currentView,$v1)){
            $this -> currentView = "IntroScreenView";
        };
        echo "<br>fin<br>";
    }
    
    
    
    
    
    
    private function Error($error){
        echo "<br><h2>error! - $error</h2><br>";
        $this->dataPassedToView["error"] = $error;
    }
    
    
    
}
?>