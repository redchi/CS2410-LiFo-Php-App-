<?php
Class SelectItemCategoryView extends View{
    
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
  <meta name="description" content="Website Maker Description">
  
  <title>select category</title>
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
<body style = "background-color: #232323;" >
 '.parent::DisplayNavBar().'

<section class="engine"><a href="https://mobirise.info/l">free site templates</a></section><section class="features18 popup-btn-cards cid-rX6nPpUOly" id="features18-11">

    

<div class="container">
        <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
            Please select a category</h2>
        
        <div class="media-container-row pt-5 ">
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <form action = "/UserInteraction" method="POST" id = "pet">
                        <input type=hidden name = "itemCategorySelected" value ="pet">
                    </form>
                <div class="card-wrapper ">
                    <div class="card-img">
                        <div class="mbr-overlay"></div>
                        <div class="mbr-section-btn text-center"><a onclick="document.getElementById(\'pet\').submit();" class="btn btn-secondary display-4">Select</a></div>
                        <img src="'.URL.'/View/assets/images/mbr-676x452.jpeg" alt="Mobirise" title="">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-5">
                            Pets</h4>
                        
                    </div>
                </div>
            </div>
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <form action = "/UserInteraction" method="POST" id = "phone">
                        <input type=hidden name = "itemCategorySelected" value ="phone">
                    </form>
                <div class="card-wrapper">
                    <div class="card-img">
                        <div class="mbr-overlay"></div>
                        <div class="mbr-section-btn text-center"><a onclick="document.getElementById(\'phone\').submit();" class="btn btn-secondary display-4">Select</a></div>
                        <img src="'.URL.'/View/assets/images/mbr-676x451.jpeg" alt="Mobirise" title="">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-5">
                            Phones</h4>
                        
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
			    <form action = "/UserInteraction" method="POST" id = "jewellery">
                        <input type=hidden name = "itemCategorySelected" value ="jewellery">
                    </form>
                <div class="card-wrapper">
                    <div class="card-img">
                        <div class="mbr-overlay"></div>
                        <div class="mbr-section-btn text-center"><a  onclick="document.getElementById(\'jewellery\').submit();" class="btn btn-secondary display-4">Select</a></div>
                        <img src="'.URL.'/View/assets/images/mbr-676x444.jpeg" alt="Mobirise" title="">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-5">
                            jewellery</h4>
                        
                    </div>
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
  <script async src="'.URL.'/View/assets/mbr-popup-btns/mbr-popup-btns.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="'.URL.'/View/assets/theme/js/script.js"></script>
  
  
</body>
</html>
';
        
        echo $html;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>