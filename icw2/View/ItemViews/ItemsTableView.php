<?php
Class ItemsTableView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $countIndex = 0;  
        $loggedinUser = $data["loggedInUsername"];
        $loggedin =  isset($loggedinUser);
        
        if(isset($data["countIndex"])){
            $countIndex = $data["countIndex"];
        }
        
        $allItems = $data["queryResult"];
        
        $tableHtml = "
            <tr>
    			<td>Item Name </td>
    			<td>Category </td>
    			<td>Colour</td>
    			<td>Date</td>
    		</tr>"; 

        foreach($allItems as $itemObj){
            $ID = $itemObj->ItemID;
            $name = $itemObj->Name;
            $category = $itemObj->Category;
            $colour = $itemObj->Colour;
            $date = $itemObj->DateFound;
            
           
            $htmlTabeRowTag= "";
            $loggedin = true;
            if($loggedin == true){
                $htmlTabeRowTag = '<tr onclick="document.getElementById(\''."item-id-$ID".'\').submit();">';
            }
            else{
                $htmlTabeRowTag = '<tr>';
            }
            
            
            $htmlRow =
            "<tr>".'<form id="item-id-'.$ID.'" action="'.URL."/view_item/".$ID.'">
          
             </form>'
                 .$htmlTabeRowTag."
                <td>$name </td>
                <td>$category </td>
                <td>$colour</td>
                <td>$date</td>
              </tr>"; 
            
            $tableHtml = $tableHtml.$htmlRow;
        }
        
        $backButtonHtml = "";
        if($loggedin == true){
            $backButtonHtml = '     
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "logoutClicked" value ="">
            	<button type = "submit">Sign out</button>
            </form>';
        }
        else{
            $backButtonHtml = '
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "tableViewLoginClicked" value ="">
            	<button type = "submit">Login in</button>
            </form>';
        }
        
        
        $html = '
        <!DOCTYPE html>
        <html>
            <body>
            
            <h1>Main item list VIEW!</h1><br>
                       
            <table  border = "5">
            	<tbody>
            	'.$tableHtml.'
            	</tbody>
            </table>


            <form action = "'.URL.'/add_item_category">
            	<button type = "submit">Add an item</button>
            </form>

              <br>
            <form action =  "'.URL.'/all_item_requests">
            	<button type = "submit">admin view all requests</button>
            </form>

            <br>
            '.$backButtonHtml.'
            <br>

            </body>
        </html>';
        
        
        echo $html;
    }
}
?>