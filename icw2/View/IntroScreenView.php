<?php
/*
 * CS2410 Internet Applications and Techniques Coursework
 * Aston University - Asim Younas - 180050734 - April 2020
 *
 */

/*
 * for info on views go to View/View.php
 */
Class IntroScreenView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
       <!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="'.URL.'/View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="">
  
  <title>Home</title>
  <link rel="preload" as="style" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
<link rel="stylesheet" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap.min.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/tether/tether.min.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/theme/css/style.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="'.URL.'/View/assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  '.parent::DisplayNavBar().'

<section class="engine"><a href="https://mobirise.info/z">best html templates</a></section><section class="header6 cid-rX5PqCNRUi mbr-fullscreen" id="header6-3">

    

    

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">
                    Find the lost</h1>
                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">Find your lost items from our worldwide database &nbsp;</p>
                <div class="mbr-section-btn align-center">
				<a class="btn btn-md btn-secondary display-4" href="'.URL."/Login".'">Log in</a> 
				<a class="btn btn-md btn-secondary display-4" href="'.URL."/Register".'">Register</a> 
				<a class="btn btn-md btn-secondary display-4" href="'.URL."/Home".'">Continue as Guest</a>
				</div>
            </div>
        </div>
    </div>

    
</section>


  <script src="'.URL.'/View/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="'.URL.'/View/assets/popper/popper.min.js"></script>
  <script src="'.URL.'/View/assets/bootstrap/js/bootstrap.min.js"></script>
  <script async src="'.URL.'/View/assets/tether/tether.min.js"></script>
  <script async src="'.URL.'/View/assets/smoothscroll/smooth-scroll.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="'.URL.'/View/assets/theme/js/script.js"></script>
  
  
</body>
</html> ';
        
        
        
        echo $html;
    }
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>