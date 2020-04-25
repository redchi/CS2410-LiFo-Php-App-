<?php
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
        echo print_r($dir);
   
       
        
        
        
        $username = $foundByUser->Username;
        $email = $foundByUser->Email;     
        $ID = $itemToDisplay->ItemID;
        $name = $itemToDisplay->Name;
        $desc = $itemToDisplay->Description;
        $category = $itemToDisplay->Category;
        $colour = $itemToDisplay->Colour;
        $date = $itemToDisplay->DateFound;
        $picsLocation = $itemToDisplay->PhotosFolderLoc;
        
        $this->drawImageSlideShow($ID);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Item detail view!</h1>
			    <br>
                <h3>  got item! name = '.$name .'
                <br> user found by = '.$username.'

                </h3>

                <form action = "./index.php" method = "POST">
                    <input type=hidden name = "itemID" value ="'.$ID.'">
                	<input type=hidden name = "requestItemClicked" value ="">
                	<button type = "submit">Request this item</button>
                </form>
                <br>
                <form action = "./index.php" method = "POST">
                	<input type=hidden name = "backButtonClicked" value ="">
                	<button type = "submit">back</button>
                </form>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
    
    
    
    
    private function drawImageSlideShow($itemID){
        $path = "C:\Users\asim1\git\CS2410 LiFo Php App\icw2\UploadedImages\\".$itemID;
        $folder = scandir($path,1);
        $count = count($folder) - 2;

        $allPicsBlockHtml = "";
        $buttonBlockHtml = "";
        
        for($i=0; $i<$count; $i++){
            $pic = $folder[$i];
            $picPath = $path."\\".$pic;   
            $picHtml = 
          '<div class="mySlides fade">
            <div class="numbertext">'.($i+1).' / '.($count+1).'</div>
                <img src="'.$picPath.'" style="width:100%">
            <div class="text"> </div>
          </div>';
            $allPicsBlockHtml = $allPicsBlockHtml.$picHtml;
        }
     
        for($i=0; $i<$count; $i++){
            $buttonHtml = '<span class="dot" onclick="currentSlide('.$i.')"></span>';
            $buttonBlockHtml = $buttonBlockHtml . $buttonHtml;
        }

        $photoGalHtml=
        
        '
       
    <style>
    * {box-sizing: border-box}
    body {font-family: Verdana, sans-serif; margin:0}
    .mySlides {display: none}
    img {vertical-align: middle;}
    
    /* Slideshow container */
    .slideshow-container {
      max-width: 1000px;
      position: relative;
      margin: auto;
    }
    
    /* Next & previous buttons */
    .prev, .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -22px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
    }
    
    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    
    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
      background-color: rgba(0,0,0,0.8);
    }
    
    /* Caption text */
    .text {
      color: #f2f2f2;
      font-size: 15px;
      padding: 8px 12px;
      position: absolute;
      bottom: 8px;
      width: 100%;
      text-align: center;
    }
    
    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    
    /* The dots/bullets/indicators */
    .dot {
      cursor: pointer;
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }
    
    .active, .dot:hover {
      background-color: #717171;
    }
    
    /* Fading animation */
    .fade {
      -webkit-animation-name: fade;
      -webkit-animation-duration: 1.5s;
      animation-name: fade;
      animation-duration: 1.5s;
    }
    
    @-webkit-keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }
    
    @keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }
    
    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .prev, .next,.text {font-size: 11px}
    }
    </style>
    
    <div class="slideshow-container">
    
    '.$allPicsBlockHtml.'
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    
    </div>
    <br>
    
    <div style="text-align:center">
        '.$buttonBlockHtml.'
    </div>
    
    <script>
    var slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }
    </script>



        ';
        
        
        echo $photoGalHtml;
        
        
        
    }
    
    
    
    
    
    
    
    
    
}


?>