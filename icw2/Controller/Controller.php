<?php
include_once "View/View.php";
include_once 'Controller/SqlHandler.php';

session_start();
class  Controller{
    
    
    public $SqlHandler;
    
    
    public $views; 
    public $pointer;
    
    private $currentView;
    
    public function __construct(){
        $viewNames = array("IntroScreenView","ItemsTableView"
            ,"RegisterView","LoginView");
        
        foreach($viewNames as $viewName){
            $view = new $viewName();
            $this->views[$viewName] = $view;
        };
        
        $this -> SqlHandler = new SqlHandler();
        echo"<h1>DONE</h1>";
    }
    
    public function invoke($method,$data){
        echo "<br>called<br>method = $method data = $data<br> 

        prev view ".$this -> currentView."<br>";
        if($method == null){
            $this->default();
        }
        else if(is_callable(array('Controller', $method))){
            $this->$method();
        }
        else{
            $this->Error("method $method not found");
        }
        
        $this->DisplayView();
        $this->saveState();
        
        $this->SqlHandler->getAllUserIds();
        
        echo "<br>
        current view ".$this -> currentView."<br>";
        
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
            $this->views[$this->currentView]->draw("data");
        }
        
    }
    
    private function DisplayIntroScreenView(){
        $this->views[$this->currentView]->draw("data");
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
     //   echo $a."  view <br>";
    }
    
    
    
    
    
    
    private function Error($error){
        echo "<br><h2>error! - $error</h2><br>";
    }
    
    
    
}
?>