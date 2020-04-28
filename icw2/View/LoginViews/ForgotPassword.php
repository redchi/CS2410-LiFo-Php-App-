<?php
Class ForgotPassword extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>FORGOT PASSWORD VIEW!</h1>
            
                <br>
                <form action = "/UserInteraction" method = "POST">
                  <input type="text" name="email" placeholder =email required><br>
                  <input type="hidden" name = "emailSubmitForPasswordReset" value ="">
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
  <meta name="description" content="Web Site Builder Description">
  
  <title>Enter email FP</title>
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

<section class="engine"><a href="https://mobirise.info/m">web design templates</a></section><section class="header5 cid-rX67acGoRh mbr-fullscreen" id="header5-p">

    

    
    <div class="container">
     <div style="height:0px;overflow:hidden">
                <script>               
                    function nextPage() {
                      alert("Please wait while we send the reset code by email, the page may seem unresponsive, do not click any additional buttons you will automatically be redirected, press ok to continue.");
                      document.getElementById(\'emailForm\').submit();
                    }
                </script>
  
            </div>

        <div class="row justify-content-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center pb-3 mbr-fonts-style display-1">
                    Please enter your email</h1>
                <p class="mbr-text align-center display-5 pb-3 mbr-fonts-style">
                   We will send you a password reset code<br>Please note it takes up to a minute to send the email, <strong>this page may freeze</strong><br></p>
                
            </div>
        </div>
      
       <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="align-center pb-2 mbr-fonts-style display-2"></h2>
                
            </div>
        </div>

        <div class="row py-2 justify-content-center">
            <div class="col-12 col-lg-6  col-md-8 ">
                <!---Formbuilder Form--->
                <form action="'.URL."/UserInteraction".'"  id = "emailForm" method="POST" class="mbr-form form-with-styler">			
                    <div class="dragArea row">
                        <div class="form-group col" data-for="email">
                            <input type="email" name="email" placeholder="Email" data-form-field="Email" required="required" class="form-control display-7" id="email-header5-p">
                        </div>
                         <input type="hidden" name = "emailSubmitForPasswordReset" value ="">               
                        <div class="col-auto input-group-btn"><button  onclick = "nextPage()" type="submit" class="btn  btn-secondary display-4">Enter</button></div>
                    </div>
                </form><!---Formbuilder Form--->
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