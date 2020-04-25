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
            "<tr>".'<form id="req-id-'.$requestID.'" method="POST" action="./index.php">
             <input type="hidden" name="requestTableRowClicked" value='.$requestID.'>
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
        
        
        echo $html;
        

    }
}
?>