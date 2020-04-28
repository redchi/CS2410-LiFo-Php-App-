<?php
Class AllRequestsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $countIndex = 0;

        if(isset($data["countIndex"])){
            $countIndex = $data["countIndex"];
        }
        
        $allObjs = $data["queryResult"];
        echo "## got ##<br>";
       // echo print_r($allObjs);
        $tableHtml = "
            <tr>
    			<td>Item Requested </td>
                <td>Item Category </td>
    			<td>Requested by </td>
    		</tr>";
        
        foreach($allObjs as $rowObj){
      //      echo print_r($rowObj);
            
            $itemObj = $rowObj["item"];
            $userObj = $rowObj["user"];

            $requestObj  = $rowObj["request"];
           
            
            $itemName = $itemObj->Name;
            //echo "$itemName ##############";
            
            $itemCat = $itemObj->Category;
            $username = $userObj->Username;
            $requestID = $requestObj->RequestID;
            
 
            
            
            $htmlRow =
            "<tr>".'<form id="req-id-'.$requestID.'"  action="/view_item_request/'.$requestID.'">
           
             </form>'
                 .'<tr onclick="document.getElementById(\''."req-id-$requestID".'\').submit();">'."
                <td>$itemName </td>
                <td>$itemCat </td>
                <td>$username</td>
                  </tr>";
                 
                 $tableHtml = $tableHtml.$htmlRow;
        }
        

        
        
        $html = '
        <!DOCTYPE html>
        <html>
            <body>
            
            <h1>ALL REQUESTS  VIEW!</h1><br>
            
            <table  border = "5">
            	<tbody>
            	'.$tableHtml.'
            	</tbody>
            </table>
            	    
            <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "nextPageOnRTableClicked" value ='.$countIndex.'>
            	<button type = "submit">next item page</button>
            </form>
            	    
            <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "previousItemPageClicked" value ='.$countIndex.'>
            	<button type = "submit">prev item page</button>
            </form>

            	<br>    
            	<form action = "./index.php" method = "POST">
					<input type=hidden name = "backButtonClicked" value ="">
					<button type = "submit">back</button>
				<form>
                
            </body>
        </html>';
        
        
        $html = '<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.10, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="'.URL.'/View/assets/images/logo1-122x122.png" type="image/x-icon">
  <meta name="description" content="Web Site Maker Description">
  
  <title>admin - all user requests</title>
  <link rel="preload" as="style" href="'.URL.'/View/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
<link rel="stylesheet" href="'.URL.'/View/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
<link rel="stylesheet" href="'.URL.'/View/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap.min.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="'.URL.'/View/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/tether/tether.min.css">
  <link rel="stylesheet" href="'.URL.'/View/assets/theme/css/style.css">
  <link rel="preload" as="style" href="'.URL.'/View/assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="'.URL.'/View/assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
'.parent::DisplayNavBar().'
<section class="engine"><a href="https://mobirise.info/f">easy site maker</a></section><section class="section-table cid-rXi43xf3cL" id="table1-1b">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
          Admin - All User Requests</h2>
      <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5">Click on a request to view more information about it</h3>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="dataTables_filter">
                  <label class="searchInfo mbr-fonts-style display-7">Search:</label>
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
                      Item Requested</th><th class="head-item mbr-fonts-style display-7">Category</th><th class="head-item mbr-fonts-style display-7">
                      Requested By</th></tr>
            </thead>

            <tbody>
              
              
              '.$this->makeRows($allObjs).'
              
            
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


  <script src="'.URL.'/View/assets/popper/popper.min.js"></script>
  <script src="'.URL.'/View/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="'.URL.'/View/assets/bootstrap/js/bootstrap.min.js"></script>
  <script async src="'.URL.'/View/assets/datatables/jquery.data-tables.min.js"></script>
  <script async src="'.URL.'/View/assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/nav-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/dropdown/js/navbar-dropdown.js"></script>
  <script async src="'.URL.'/View/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script async src="'.URL.'/View/assets/tether/tether.min.js"></script>
  <script async src="'.URL.'/View/assets/smoothscroll/smooth-scroll.js"></script>
  <script async src="'.URL.'/View/assets/theme/js/script.js"></script>
  
  
</body>
</html>';
        
        echo $html;
        

    }
    
    
    private function makeRows($allObjs){
       
        $rowBlockHtml = "";
        foreach($allObjs as $rowObj){
            //      echo print_r($rowObj);
            
            $itemObj = $rowObj["item"];
            $userObj = $rowObj["user"];
            
            $requestObj  = $rowObj["request"];
            
            
            $itemName = $itemObj->Name;
            //echo "$itemName ##############";
            
            $itemCat = $itemObj->Category;
            $username = $userObj->Username;
            $requestID = $requestObj->RequestID;
            
            $htmlRow = 
             '<tr style = "cursor: pointer;" onclick="document.getElementById(\''."req-id-$requestID".'\').submit();"> 
              <td class="body-item mbr-fonts-style display-7"><form id="req-id-'.$requestID.'"  action="/view_item_request/'.$requestID.'"></form>'.$itemName.'</td>
			  <td class="body-item mbr-fonts-style display-7">'.$itemCat.'</td>
              <td class="body-item mbr-fonts-style display-7">'.$username.'</td>
			 </tr>';
            
            
            
//             $htmlRow =
//             "<tr>".'<form id="req-id-'.$requestID.'"  action="/view_item_request/'.$requestID.'">
                
//              </form>'
//                 .'<tr onclick="document.getElementById(\''."req-id-$requestID".'\').submit();">'."
//                 <td>$itemName </td>
//                 <td>$itemCat </td>
//                 <td>$username</td>
//                   </tr>";
                
                $rowBlockHtml = $rowBlockHtml.$htmlRow;
        }
        return $rowBlockHtml;
        
    }
    
}
?>