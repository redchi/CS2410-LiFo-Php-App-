<?php
Class HomeView extends View{
    
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
  <link rel="shortcut icon" href="View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="Site Builder Description">
  
  <title>home</title>
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
<body  style = "background-color: #232323;">
  '.parent::DisplayNavBar().'

<section class="engine"><a href="https://mobirise.info/q">free responsive site templates</a></section><section class="features14 cid-rXi8zPa3Ld" id="features14-1h">
    
    

    
    <div class="container align-center">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">Home</h2>
        <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5">Made by A.Younas - 180050734 - Coursework CS2410</h3>
        <div class="media-container-column">
            <div class="row justify-content-center">
                <div class="card p-4 col-12 col-md-6 col-lg-4">
                    <div class="media pb-3">
                        <div class="card-img align-self-center">
                            <span class="mbr-iconfont mbri-search"></span>
                        </div>
                        <div class="media-body">
                            <h4 class="card-title py-2 align-left mbr-fonts-style display-5">
                                Items found - 824</h4>
                        </div>
                    </div>                
                    <div class="card-box align-left">
                        <p class="mbr-text mbr-fonts-style display-7">We have a goal to of finding all the lost items in the word!</p>
                    </div>
                </div>

                <div class="card p-4 col-12 col-md-6 col-lg-4">
                <div class="media pb-3">
                    <div class="card-img align-self-center">
                        <span class="mbr-iconfont mbri-like"></span>
                    </div>
                    <div class="media-body">
                        <h4 class="card-title py-2 align-left mbr-fonts-style display-5">
                                Items approved - 692</h4>
                    </div>
                </div>
                    <div class="card-box align-left">
                        <p class="mbr-text mbr-fonts-style display-7">
                            we have one of the highest rate of approval for lost items&nbsp;</p>
                    </div>
                </div>

                <div class="card p-4 col-12 col-md-6 col-lg-4">
                <div class="media pb-3">
                    <div class="card-img align-self-center">
                        <span class="mbr-iconfont mbri-smile-face"></span>
                    </div>
                    <div class="media-body">
                        <h4 class="card-title py-2 align-left mbr-fonts-style display-5">Users satisfied - 82%</h4>
                    </div>
                </div>
                    <div class="card-box align-left">
                        <p class="mbr-text mbr-fonts-style display-7">
                           Mostly all of our users were happy with our service</p>
                    </div>
                </div>

                
            </div>
            <div class="media-container-row image-row">
                <div class="mbr-figure" style="width: 60%;">
                    <img src="View/assets/images/mbr-1332x882.jpg" alt="Mobirise" title="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section info3 cid-rXib82ke13" id="info3-1k">

    

    

    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column title col-12 col-md-10">
                <h2 class="align-left mbr-bold mbr-white pb-3 mbr-fonts-style display-2">
                    Find your lost items</h2>
                
                <p class="mbr-text align-left mbr-white mbr-fonts-style display-7">Please note you need to be signed in to make a item request or add a found item.</p>
                <div class="mbr-section-btn align-left py-4"><a class="btn btn-secondary display-4" href="'.URL.'/all_items">View Found Items</a></div>
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
</html>


        ';
        
        echo $html;
    }
}
?>