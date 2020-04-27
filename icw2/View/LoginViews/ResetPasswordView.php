<?php
Class ResetPasswordView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Reset password VIEW!</h1>
            
                <br>
                <form action = "/UserInteraction" method = "POST">
                  <input type="password" name="password" placeholder = "password"><br>
                  <input type="password" name="password2" placeholder ="Confirm password"><br><br>
                  <input type="hidden" name = "newPasswordEntered" value ="">
                  <input type="submit" value="Submit">
                </form>
                <br>
            
            

				<br>
            
            
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
  <meta name="description" content="Site Builder Description">
  
  <title>enter new password</title>
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
<section class="engine"><a href="https://mobirise.info/l">free web templates</a></section><section class="header15 cid-rXhXwHmDU8 mbr-fullscreen" id="header15-16">

    

    

    <div class="container align-right">
        <div class="row">
            <div class="mbr-white col-lg-8 col-md-7 content-container">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">Enter a new password</h1>
                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    Please make sure you have a minimum of 6 characters with at least 1 capital letter and 1 number in your password</p>
            </div>
            <div class="col-lg-4 col-md-5">
                <div>
                    <div class="media-container-column">
                        <!---Formbuilder Form--->
                        <form action="'.URL."/UserInteraction".'" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                            </div>
                            <div class="dragArea row">                           
                            	  <div class="col-md-12 form-group " data-for="email">
                                    <input type="password" name="password" placeholder="Password" data-form-field="Email" required="required" class="form-control px-3 display-7" id="password-header15-16">
                                </div>
                                <div data-for="phone" class="col-md-12 form-group ">
                                    <input type="password" name="password2" placeholder="Confirm Password" data-form-field="Phone" class="form-control px-3 display-7" id="phone-header15-16">
                                </div>
                                 <input type="hidden" name = "newPasswordEntered" value ="">
                 

                                <div class="col-md-12 input-group-btn"><button type="submit" class="btn btn-secondary btn-form display-4">Change Password</button></div>
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