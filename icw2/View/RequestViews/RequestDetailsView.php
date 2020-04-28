<?php
Class RequestDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $requestObj = $data["request"];
        
        $itemObj = $requestObj["item"];
        $userObj = $requestObj["user"];
        $requestObj = $requestObj["request"];
        
        
        
        $itemName = $itemObj->Name;
        $itemID = $itemObj->ItemID;
        $itemCat = $itemObj->Category;
        $itemDate = $itemObj->DateFound;
        $itemLoc = $itemObj->Location;
    
        $username = $userObj->Username;
        $email = $userObj->Email;
        
      
        $requestDesc = $requestObj->Description;
        $requestID = $requestObj->RequestID;
       
        
        $html = '<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="'.URL.'/View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="Web Site Builder Description">
  
  <title>admin - view request</title>
  <link rel="preload" as="style" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
<link rel="stylesheet" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
<link rel="stylesheet" href="'.URL.'/View/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
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
<body  style = "background-color: #232323;">
 '.parent::DisplayNavBar().'

<section class="engine"><a href="https://mobirise.info/z">best css templates</a></section><section class="mbr-section article content10 cid-rXi6IU1uU3" id="content10-1f">
    
     

    <div class="container">
        <div class="inner-container" style="width: 66%;">
            <hr class="line" style="width: 25%;">
            <div class="section-text align-center mbr-white mbr-fonts-style display-2">Admin - View Item Request</div>
            <hr class="line" style="width: 25%;">
        </div>
    </div>
</section>

<section class="features11 cid-rXi5gnMLyp" id="features11-1d">

    

    

    <div class="container">   
        <div style="height:0px;overflow:hidden">
            <script>
                function deny() {
                  alert("Please wait while we send the deny email, the page may seem unresponsive, do not click any additional buttons you will automatically be redirected, press ok to continue.");
                  document.getElementById(\'deny\').submit();
                }
                
                function approve() {
                  alert("Please wait while we send the approval email, the page may seem unresponsive, do not click any additional buttons you will automatically be redirected, press ok to continue.");
                  document.getElementById(\'approve\').submit();
                }
            </script>
             <form action = "/UserInteraction" id = "approve" method = "POST">
    			<input type=hidden name = "approveRequest" value ="'.$requestID.'">
    		</form>
    		<form action = "/UserInteraction" id = "deny" method = "POST">
    			<input type=hidden name = "denyRequest" value ="'.$requestID.'">
    		</form>
        </div>
        
        <div class="col-md-12">
            <div class="media-container-row">
                <div class="mbr-figure m-auto" style="width: 50%;">
                    <img src="'.URL.'/View/assets/images/background9.jpg" alt="Mobirise" title="">
                </div>
                <div class=" align-left aside-content">
                    <h2 class="mbr-title pt-2 mbr-fonts-style display-2">
                        Item Requested - '.$itemName.'&nbsp;</h2>
                    <div class="mbr-section-text">
                        <p class="mbr-text mb-5 pt-3 mbr-light mbr-fonts-style display-5">Item category - '.$itemCat.'<br>Item found Location - '.$itemLoc.'<br>Date found - '.$itemDate.'&nbsp;</p>
                    </div>

                    <div class="block-content">
                        <div class="card p-3 pr-3">
                            <div class="media">
                                <div class=" align-self-center card-img pb-3">
                                    <span class="mbr-iconfont mbri-user"></span>
                                </div>     
                                <div class="media-body">
                                    <h4 class="card-title mbr-fonts-style display-5">User Requesting</h4>
                                </div>
                            </div>                

                            <div class="card-box">
                                <p class="block-text mbr-fonts-style display-7">
                                   Username - '.$username.'&nbsp;<br>Email - '.$email.'&nbsp;</p>
                            </div>
                        </div>

                        <div class="card p-3 pr-3">
                            <div class="media">
                                <div class="align-self-center card-img pb-3">
                                    <span class="mbr-iconfont mbri-bookmark"></span>
                                </div>     
                                <div class="media-body">
                                    <h4 class="card-title mbr-fonts-style display-5">
                                        Request Reason</h4>
                                </div>
                            </div>                

                            <div class="card-box">
                                <p class="block-text mbr-fonts-style display-7">'.$requestDesc.'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>          
</section>

<section class="mbr-section content8 cid-rXi6yaz4hm" id="content8-1e">

    

    <div class="container">
        <div class="media-container-row title">
            <div class="col-12 col-md-8">
                <div class="mbr-section-btn align-center"><a class="btn btn-primary display-4" onclick="approve()">Approve</a>
                    <a class="btn btn-info display-4" onclick="deny()">Deny</a> <a class="btn btn-white display-4" href="'.URL."/view_item/".$itemID.'">View Item</a></div>
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
</html>';
        
        
        
        echo $html;
    }
}
?>