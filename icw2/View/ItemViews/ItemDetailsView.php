<?php
/*
 * CS2410 Internet Applications and Techniques Coursework
 * Aston University - Asim Younas - 180050734 - April 2020
 *
 */

/*
 * for info on views go to View/View.php
 */
Class ItemDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        
        $itemToDisplay = $data['item'];
        $foundByUser = $data['user'];
        $path = "C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages";
        $dir = scandir($path,1);
        echo "##z1";
        echo print_r($dir);
   
       
        
        
     
        $username = $foundByUser->Username;    
        $itemID = $itemToDisplay->ItemID;
        $name = $itemToDisplay->Name;
        $desc = $itemToDisplay->Description;
        $category = $itemToDisplay->Category;
        $colour = $itemToDisplay->Colour;
        $date = $itemToDisplay->DateFound;
        $location = $itemToDisplay->Location;
        
      
    
        
        $html = '<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="'.URL.'/View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="Website Maker Description">
  
  <title>View item</title>
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

<section class="engine"><a href="https://mobirise.info/z">best html templates</a></section><section class="mbr-section content4 cid-rXmRGH1vU6" id="content4-1t">

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2">
                    Item - '.$name.'</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">items are entered by our users so some information may be generalised</h3>
                
            </div>
        </div>
    </div>
</section>

<section class="step2 cid-rXmRTKN1yM" id="step2-1u">

    

    
    
    <div class="container">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style align-center display-2">Item Details</h2>
        
        <div class="step-container row justify-content-center">
            <div class="card col-12 pb-4 col-md-4 separline">
                <div class="step-element">
                    <div class="step-wrapper pb-3">
                        <h3 class="step d-flex align-items-center justify-content-center m-auto"></h3>
                    </div>          
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">Category</h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">'.$category.'</p>
                    </div>
                </div>
            </div>

            <div class="card col-12 separline pb-4 col-md-4">
                <div class="step-element">
                    <div class="step-wrapper pb-3">
                        <h3 class="step d-flex align-items-center justify-content-center m-auto"></h3>
                    </div>          
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">Colour</h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">'.$colour.'</p>
                    </div>
                </div>
            </div>

            <div class="card col-md-4 col-12 separline pb-4">
                <div class="step-element">
                    <div class="step-wrapper pb-3">
                        <h3 class="step d-flex align-items-center justify-content-center m-auto"></h3>
                    </div>          
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">Date Found</h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">'.$date.'</p>
                    </div>
                </div>
            </div>

            <div class="card col-12 separline col-md-6">
                <div class="step-element">
                    <div class="step-wrapper pb-3">
                        <h3 class="step d-flex align-items-center justify-content-center m-auto"></h3>
                    </div>          
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">
                            Location found</h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">'.$location.'</p>
                    </div>
                </div>
            </div>
            
            <div class="card col-12 separline last-child col-md-6">
                <div class="step-element">
                    <div class="step-wrapper pb-3">
                        <h3 class="step d-flex align-items-center justify-content-center m-auto"></h3>
                    </div>          
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">
                            Found by</h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">'.$username.'</p>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
            
            
        </div>
    </div>
</section>

<section class="mbr-section content4 cid-rX63eAjlj9" id="content4-m">

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2">Item description</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">
                   '.$desc.'
                </h3>
                
            </div>
        </div>
    </div>
</section>

<section class="mbr-section content8 cid-rX63eATmuw" id="content8-n">

    

    <div class="container">
        <div class="media-container-row title">
            <div class="col-12 col-md-8">
                <div class="mbr-section-btn align-center"><a class="btn btn-secondary display-4" href="'.URL."/request_item/".$itemID.'">Request this item</a></div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section content4 cid-rXn1f4QnhP" id="content4-1v">

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2">Item Photos</h2>
                
                
            </div>
        </div>
    </div>
<section class="carousel slide cid-rXmRvwDjSA" data-interval="false" id="slider2-1s">

    
    <div class="container content-slider">
        <div class="content-slider-wrap">
            <div>
			<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="false" data-interval="false">
			
			
			'.$this->drawImageSlideShow($itemID).'
			
			<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider2-1s">
			<span aria-hidden="true" class="mbri-left mbr-iconfont">
			</span><span class="sr-only">Previous</span>
			</a><a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider2-1s">
			<span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a></div></div> 
        </div>
    </div>
</section>

  <script src="'.URL.'/View/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="'.URL.'/View/assets/popper/popper.min.js"></script>
  <script src="'.URL.'/View/assets/bootstrap/js/bootstrap.min.js"></script>
  <script async src="'.URL.'/View/assets/tether/tether.min.js"></script>
  <script async src="'.URL.'/View/assets/smoothscroll/smooth-scroll.js"></script>
  <script async src="'.URL.'/View/assets/vimeoplayer/jquery.mb.vimeo_player.js"></script>
  <script async src="'.URL.'/View/assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="'.URL.'/View/assets/ytplayer/jquery.mb.ytplayer.min.js"></script>
  <script async src="'.URL.'/View/assets/theme/js/script.js"></script>
  <script async src="'.URL.'/View/assets/slidervideo/script.js"></script>
  
  
</body>
</html>';
        
        echo $html;
    }
    
    
    
    
    private function drawImageSlideShow($itemID){
        $dir = ".\UploadedImages\\".$itemID;
      $path =URL."/UploadedImages";

      if(file_exists($dir)== true){
          
      
            $folder = scandir($dir,1);
            $count = count($folder) - 2;
    
            $allPicsBlockHtml = "";
         
            for($i=0; $i<$count; $i++){
                if($i+1 == $count){
                    $active = "active";
                }
                else{
                    $active = "";
                }
                $pic = $folder[$i];
                $picPath = $path."/"."$itemID/".$pic; 
                $picHtml = 
                '	<div class="carousel-item slider-fullscreen-image '.$active.'" data-bg-video-slide="false" style="background-image: url('.$picPath.');">
    			<div class="container container-slide">
    			<div class="image_wrapper">
    			<img src="'.$picPath.'">
    			<div class="carousel-caption justify-content-center">
    			<div class="col-10 align-center">
    			</div></div></div></div></div>';
                $allPicsBlockHtml = $allPicsBlockHtml.$picHtml;
            }
         
          
      }
      else{
          
          $picPath = URL."/UploadedImages/Default/NoImageAvailable.jpg";
          
          $allPicsBlockHtml = '	<div class="carousel-item slider-fullscreen-image active" data-bg-video-slide="false" style="background-image: url('.$picPath.');">
    			<div class="container container-slide">
    			<div class="image_wrapper">
    			<img src="'.$picPath.'">
    			<div class="carousel-caption justify-content-center">
    			<div class="col-10 align-center">
    			</div></div></div></div></div>';
          
          
          
      }
      
      $block = '<div class="carousel-inner" role="listbox">
                '.$allPicsBlockHtml.'
               </div>';
      return $block;

        
       
        //return $photoGalHtml;
        
        
        
    }
    
    
    
    
    
    
    
    
    
}


?>