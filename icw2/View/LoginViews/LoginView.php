<?php
/*
 * CS2410 Internet Applications and Techniques Coursework
 * Aston University - Asim Younas - 180050734 - April 2020
 *
 */

/*
 * for info on views go to View/View.php
 */
Class LoginView extends View{
    
    public function __construct(){
        //nothing
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
  <meta name="description" content="Site Builder Description">
  
  <title>Login</title>
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
<body  style = "background-color: #232323;">
 '.parent::DisplayNavBar().'
<section class="engine"><a href="https://mobirise.info/v">free html templates</a></section><section class="mbr-section form1 cid-rX61vtPYFe" id="form1-k">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    Log in</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Please enter your credentials</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8">
                <!---Formbuilder Form--->
              <div>
                <form action="'.URL."/UserInteraction".'" method="POST" class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <div class="col-md-12  form-group">
                            <input type="text" name="username" data-form-field="username" required="required" class="form-control display-7" placeholder="username" id="email-form1-k">
                        </div>
                        <div class="col-md-12  form-group">
                            <input type="password" name="password" data-form-field="Phone" class="form-control display-7" placeholder="Password" id="phone-form1-k">
                        </div>
						<input type="hidden" name = "loginAttempt" value ="">
                         <input type=hidden name = "authKey" value ="'.$data["key"].'">
                        <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-form btn-secondary display-4">Log in</button></div>
                    </div>
                </form><!---Formbuilder Form--->
                	<br><br>
                   <div class="col-12">
                <div class="mbr-section-btn align-center"><a class="btn btn-secondary display-4" href="'.URL."/Forgot_password".'">Forgot Password</a></div>
            </div><br><br>
                   <div class="col-12">
                <div class="mbr-section-btn align-center"><a class="btn btn-secondary display-4" href="'.URL."/Register".'">Register</a></div>
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