<?php
Class IntroScreenView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Lost and Found System!</h1>
                <form action = "'.URL.'/Login">
					<button type = "submit">Login</button>
				</form>
				<br>
				<form action = "'.URL.'/Register">				
					<button type = "submit">Register</button>
				</form>
                <br>
	               <form action = "'.URL.'/Home">				
					<button type = "submit">Continue as guest</button>
				</form>

                </body>
                </html>
            
        ';
        
        
        $html = '
        <!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="">
            
  <title>Home</title>
  <link rel="preload" as="style" href="View/assets/web/assets/mobirise-icons/mobirise-icons.css">
<link rel="stylesheet" href="View/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap.min.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="View/assets/tether/tether.min.css">
  <link rel="stylesheet" href="View/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="View/assets/theme/css/style.css">
  <link rel="preload" as="style" href="View/assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="View/assets/mobirise/css/mbr-additional.css" type="text/css">
            
            
            
</head>
<body>
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
                    <a href="https://mobirise.co">
                         <img src="View/assets/images/logo1-122x122.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-5" href="https://mobirise.co">Find The Lost</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="https://mobirise.co">
                        <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="https://mobirise.co"><span class="mbri-key mbr-iconfont mbr-iconfont-btn"></span>
                        Admin View</a>
                </li><li class="nav-item"><a class="nav-link link text-white display-4" href="https://mobirise.co"><span class="mbri-star mbr-iconfont mbr-iconfont-btn"></span>
                        Add item</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="https://mobirise.co"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        View Items</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="https://mobirise.co"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>
                        Login</a></li></ul>
            
        </div>
    </nav>
</section>
            
<section class="engine"><a href="https://mobirise.info/g">build a website</a></section><section class="header6 cid-rX5PqCNRUi mbr-fullscreen" id="header6-3">
            
            
            
            
            
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">
                    Find the lost</h1>
                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">Find your lost items from our worldwide database &nbsp;</p>
                <div class="mbr-section-btn align-center"><a class="btn btn-md btn-secondary display-4" href="https://mobirise.co">Log in</a> <a class="btn btn-md btn-secondary display-4" href="https://mobirise.co">Register</a> <a class="btn btn-md btn-secondary display-4" href="https://mobirise.co">Continue as Guest</a></div>
            </div>
        </div>
    </div>
            
            
</section>
            
            
  <script src="View/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="View/assets/popper/popper.min.js"></script>
  <script src="View/assets/bootstrap/js/bootstrap.min.js"></script>
  <script async src="View/assets/tether/tether.min.js"></script>
  <script async src="View/assets/smoothscroll/smooth-scroll.js"></script>
  <script async src="View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="View/assets/theme/js/script.js"></script>
            
            
</body>
</html>  ';
        
        
        
        echo $html;
    }
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>