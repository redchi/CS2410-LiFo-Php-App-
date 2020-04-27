<?php
Class AddItemDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $category = $data["Category"];
//         $user = $data["user"];
//         $item = $data["item"];
      
//         $itemName = $item->Name;
//         $itemType = $item->Category;
//         $userID = $user->UserID;
//         $itemID = $item->ItemID;
        
        
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
  <meta name="description" content="Web Site Builder Description">
  
  <title>add Item details</title>
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

<section class="engine"><a href="https://mobirise.info/f">easy web builder</a></section><section class="header15 cid-rX5TMzCGZt mbr-fullscreen" id="header15-9">

    

    

    <div class="container align-right">
        <div class="row">
            <div class="mbr-white col-lg-8 col-md-7 content-container">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Enter item details</h1>
                <p class="mbr-text pb-3 mbr-fonts-style display-5"><em>please note that special characters like "@" are not allowed in any fields except the item description.</em></p>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="form-container">
                    <div class="media-container-column" >
                        <!---Formbuilder Form--->
                        <form action="'.URL."/UserInteraction".'" method="POST" class="mbr-form form-with-styler">
					
                            <div class="dragArea row">
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="name" placeholder="item name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-9">
                                </div>
                                <div class="col-md-12 form-group " data-for="email">
                                    <input type="text" name="colour" placeholder="item colour" data-form-field="Email" required="required" class="form-control px-3 display-7" id="colour-header15-9">
                                </div>
                                <div data-for="phone" class="col-md-12 form-group ">
                                    <input type="text" name="location" placeholder="location found" data-form-field="Phone" class="form-control px-3 display-7" id="location-header15-9">
                                </div>
                              <div data-for="phone" class="col-md-12 form-group ">
                                    <input type="date" name="date found" placeholder="date found" data-form-field="Phone" class="form-control px-3 display-7" id="date found-header15-9">
                                </div>
                                <div data-for="message" class="col-md-12 form-group ">
                                    <textarea name="description" placeholder="item description" data-form-field="Message" class="form-control px-3 display-7" id="description-header15-9"></textarea>
                                </div>
                                   <input type="hidden" name = "Category" value ="'.$category.'">
                            	  <input type="hidden" name = "addItem" value ="">
                                
                                <div class="col-md-12 input-group-btn"><button type="submit" class="btn btn-secondary btn-form display-4">Submit item details</button></div>
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
</html>
';
        
        
        echo $html;
    }
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>