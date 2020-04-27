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
                <html>
                <body>
            
                <h1> ADD Item view!</h1>
			    <br>             
                </h3>

            <form action ="/UserInteraction" method = "POST">
        
        	<input type="text" placeholder="item name" name="name" required><br>
        	 <input list="colours" name="colour" placeholder="colour" required><br>
        					<datalist id="colours">
        							 <option value="Red">
        							<option value="Orange">
        							<option value="Yellow">
        							<option value="Green">
        							<option value="Blue">
        							<option value="Purple">
        							<option value="Brown">
        							<option value="Magenta">
        							<option value="Tan">
        							<option value="Cyan">
        							<option value="Olive">
        							<option value="Maroon">
        							<option value="Navy">
        							<option value="Aquamarine">
        							<option value="Turquoise">
        							<option value="Silver">
        							<option value="Lime">
        							<option value="Teal">
        							<option value="Indigo">
        							<option value="Violet">
        							<option value="Pink">
        							<option value="Black">
        							<option value="White">
        							<option value="Gray">
        					</datalist>
        	   <input type="text" placeholder="Location Found" name="location" required><br>
        	   <input type="date"  name="date" required><br>
        	  <input type="text" placeholder=" Item Description" name="description" required><br>
        	  <br>
              <input type="hidden" name = "Category" value ="'.$category.'">
        	  <input type="hidden" name = "addItem" value ="">
        	  <input type="submit" value="Submit">
        	  
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
                         <img src="'.URL.'/View/assets/images/logo1-122x122.png" alt="Mobirise" title="" style="height: 3.8rem;">
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