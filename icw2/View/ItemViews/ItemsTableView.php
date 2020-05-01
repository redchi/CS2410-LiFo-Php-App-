<?php
/*
 * CS2410 Internet Applications and Techniques Coursework
 * Aston University - Asim Younas - 180050734 - April 2020
 *
 */

/*
 * for info on views go to View/View.php
 */
Class ItemsTableView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        
        $loggedinUser = $data["loggedInUsername"];
        $loggedin =  isset($loggedinUser);
        
    
        $allItems = $data["queryResult"];
        
        
        
        
        
        
        $html = '<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="Website Builder Description">
  
  <title>all items</title>
  <link rel="preload" as="style" href="View/assets/web/assets/mobirise-icons/mobirise-icons.css">
<link rel="stylesheet" href="View/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap.min.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="preload" as="style" href="View/assets/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="View/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="View/assets/tether/tether.min.css">
  <link rel="stylesheet" href="View/assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="View/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="View/assets/theme/css/style.css">
  <link rel="preload" as="style" href="View/assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="View/assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body style = "background-color: #232323;">
'.parent::DisplayNavBar().'

<section class="engine"><a href="https://mobirise.info/v">html templates</a></section><section class="section-table cid-rXi1pnriPk" id="table1-18">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
          All Found Items</h2>
      <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5">Click on items to get more details and request it (need to be signed in), click on the columns to sort items and use the search bar to search for a specific item.</h3>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="dataTables_filter">
                  <label class="searchInfo mbr-fonts-style display-7"></label>
                  <input class="form-control input-sm" disabled="">
                </div>
            </div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch" cellspacing="0">
            <thead>
              <tr class="table-heads ">
                  
                  
                  
                  
              <th class="head-item mbr-fonts-style display-7">
                      NAME</th><th class="head-item mbr-fonts-style display-7">
                      Category</th><th class="head-item mbr-fonts-style display-7">Colour</th><th class="head-item mbr-fonts-style display-7">
                      Date Found</th></tr>
            </thead>

            <tbody>
              
              '.$this->makeRows($allItems).'
         
          
            </tbody>
          </table>
        </div>
        <div class="container table-info-container">
          <div class="row info">
            <div class="col-md-6">
              <div class="dataTables_info mbr-fonts-style display-7">
                <span class="infoBefore">Showing</span>
                <span class="inactive infoRows"></span>
                <span class="infoAfter">entries</span>
                <span class="infoFilteredBefore">(filtered from</span>
                <span class="inactive infoRows"></span>
                <span class="infoFilteredAfter"> total entries)</span>
              </div>
            </div>
            <div class="col-md-6"></div>
          </div>
        </div>
      </div>
    </div>
</section>


  <script src="View/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="View/assets/popper/popper.min.js"></script>
  <script src="View/assets/bootstrap/js/bootstrap.min.js"></script>
  <script async src="View/assets/tether/tether.min.js"></script>
  <script async src="View/assets/smoothscroll/smooth-scroll.js"></script>
  <script async src="View/assets/datatables/jquery.data-tables.min.js"></script>
  <script async src="View/assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script async src="View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="View/assets/theme/js/script.js"></script>
  
  
</body>
</html>';
        
        echo $html;
    }
    
    
    
    
    
    
    private function makeRows($allItems){
        $tableHtml = "";
        foreach($allItems as $itemObj){
            $ID = $itemObj->ItemID;
            $name = $itemObj->Name;
            $category = $itemObj->Category;
            $colour = $itemObj->Colour;
            $date = $itemObj->DateFound;
    
            
            $htmlTabeRowTag= "";
            $loggedin = $this->userLogin;
            if($loggedin == true){
                $htmlTabeRowTag = '<tr style = "cursor: pointer;" onclick="document.getElementById(\''."item-id-$ID".'\').submit();">';
            }
            else{
                $htmlTabeRowTag = '<tr>';
            }
            
            
            $htmlRow = $htmlTabeRowTag.'
                 <td class="body-item mbr-fonts-style display-7"><form id="item-id-'.$ID.'" action="'.URL."/view_item/".$ID.'"></form>'.$name.'</td>
            	 <td class="body-item mbr-fonts-style display-7">'.$category.'</td>
            	 <td class="body-item mbr-fonts-style display-7">'.$colour.'</td>
            	 <td class="body-item mbr-fonts-style display-7">'.$date.'</td>
              </tr>';
                
                $tableHtml = $tableHtml.$htmlRow;
        }
        return $tableHtml;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>