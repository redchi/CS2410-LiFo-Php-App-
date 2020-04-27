<?php
include_once 'View/IntroScreenView.php';
include_once 'View/ItemViews/ItemsTableView.php';
include_once 'View/ItemViews/ItemDetailsView.php';
include_once 'View/AddItemViews/AddItemDetailsView.php';
include_once 'View/AddItemViews/AddItemPhotosView.php';
include_once 'View/AddItemViews/SelectItemCategoryView.php';
include_once 'View/ItemViews//RequestItemView.php';
include_once 'View/LoginViews/ForgotPassword.php';
include_once 'View/LoginViews/LoginView.php';
include_once 'View/LoginViews/RegisterView.php';
include_once 'View/LoginViews/ResetCodeView.php';
include_once 'View/LoginViews/ResetPasswordView.php';
include_once 'View/RequestViews/AllRequestsView.php';
include_once 'View/RequestViews/RequestDetailsView.php';
include_once 'View/HomeView.php';
include_once 'View/ErrorView.php';
Class View{
    
    private $adminLogin;
    private $userLogin;
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        $this->adminLogin = $data["adminLoggedIn"];
        $this->userLogin = $data["userLoggedIn"];
        
        if(isset($data["error"])){
            $this->DisplayError($data["error"]);
        }
        else{
            echo"#2";
        }
        // html goes here
    }
    
    protected function DisplayError($error){
        echo "<script type='text/javascript'>alert('$error');</script>";  
    }

    protected function DisplayNavBar(){
      
        
        $additemButton = "";
        $adminViewButton ="";
        $LoginLogoutButton = '<li class="nav-item"><a class="nav-link link text-white display-4" href="'.URL."/Login".'"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span> Login</a></li>';
        
        if($this->userLogin == true ){
            $additemButton = '<li class="nav-item"><a class="nav-link link text-white display-4" href="'.URL."/add_item_category".'"><span class="mbri-star mbr-iconfont mbr-iconfont-btn"></span>Add item</a></li>';
            $LoginLogoutButton = '<li class="nav-item"><a class="nav-link link text-white display-4" href="'.URL."/Logout". '"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span> Logout</a></li>';
        }
        if($this->adminLogin == true){
            $adminViewButton = '<li class="nav-item"><a class="nav-link link text-white display-4" href="'.URL."/all_item_requests".'"><span class="mbri-key mbr-iconfont mbr-iconfont-btn"></span>Admin View</a></li>';
        }
        
        
        
        $navbarHtml ='
<section class="menu cid-rXj05hWI7h" once="menu" id="menu1-1p">
   <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="'.URL."/Home".'">
                         <img src="'.URL.'/View/assets/images/logo1-122x122.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-5" href="https://mobirise.co">Find The Lost</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
			
				<li class="nav-item"> <a class="nav-link link text-white display-4" href="'.URL."/Home".'"><span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Home</a></li>
                '.$adminViewButton.'
                '.$additemButton.'
                <li class="nav-item"><a class="nav-link link text-white display-4" href="'.URL."/All_items".'"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span> View Items</a></li>
				'.$LoginLogoutButton.'
			</ul>
            
        </div>
    </nav>
</section>';
        
        echo $navbarHtml;
    }
    
}

?>