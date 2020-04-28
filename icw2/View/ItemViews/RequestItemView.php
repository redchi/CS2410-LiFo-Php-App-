<?php
Class RequestItemView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $item = $data["item"];
        $itemName = $item->Name;
        $itemCategory = $item->Category;
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1> Request Item view!</h1>
			    <br><h3>
                 item name = '.$itemName.'
                </h3>
                <br>
            

                 <form action = "/UserInteraction" method = "POST">
                  <input type="text" name="request" placeholder = "request description" requred><br>      
                	    <input type=hidden name = "itemID" value ="'.$item->ItemID.'">
                        <input type=hidden name = "itemRequested" value ="">
                	<button type = "submit">submit</button>
                </form>
            

            
                </body>
                </html>
            
        ';
        
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
  
  <title>request item</title>
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

<section class="engine"><a href="https://mobirise.info">Mobirise</a></section><section class="header15 cid-rX6lNz5XX0 mbr-fullscreen" id="header15-w">

    

    

    <div class="container align-right">
        <div class="row">
            <div class="mbr-white col-lg-8 col-md-7 content-container">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">Item request</h1>
                <p class="mbr-text pb-3 mbr-fonts-style display-5">you want to request - '.$itemName.'<br>category - '.$itemCategory.'<br><br>please give a reason for your request</p>
            </div>
            <div class="col-lg-4 col-md-5">
                <div>
                    <div class="media-container-column">
                        <!---Formbuilder Form--->
                        <form action="'.URL."/UserInteraction".'" method="POST" class="mbr-form form-with-styler">
						     <div class="dragArea row">
                                <div data-for="message" class="col-md-12 form-group ">
                                    <textarea name="request" placeholder="Request reason" data-form-field="Message" class="form-control px-3 display-7" id="message-header15-w"></textarea>
                                </div>
                         <input type=hidden name = "itemID" value ="'.$item->ItemID.'">
                        <input type=hidden name = "itemRequested" value ="">
                	
                                <div class="col-md-12 input-group-btn"><button type="submit" class="btn btn-secondary btn-form display-4">Make request</button></div>
                            </div>
                        </form><!---Formbuilder Form--->
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
  <script async src="'.URL.'/View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="'.URL.'/View/assets/theme/js/script.js"></script>
  <script async src="'.URL.'/View/assets/formoid/formoid.min.js"></script>
  
  
</body>
</html>';
        
        echo $html;
    }
    
    
 
    
    
    
}
?>