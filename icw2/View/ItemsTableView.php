<?php
Class ItemsTableView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $countIndex = 0;  
        
        $test =  ' test = a'.' \'  '."yee";
        echo ($test);
        if(isset($data["countIndex"])){
            $countIndex = $data["countIndex"];
        }
        echo'asdasdasd\'';
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
            
            $htmlRow ="<tr>".
    			
    
     '<form id="item-id-'.$ID.'" method="GET" action="your-php-file-url">
     <input type="hidden" name="your-variable-name" value='.$ID.'>
     </form>'
    
    .'<tr onclick="document.getElementById(\''."item-id-$ID".'\').submit();">'."
        <td>$name </td>
        <td>$category </td>
        <td>$colour</td>
        <td>$date</td>
        </tr>"; 
            
            $tableHtml = $tableHtml.$htmlRow;
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


            <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "nextItemPageClicked" value ='.$countIndex.'>
            	<button type = "submit">next item page</button>
            </form>

            <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "previousItemPageClicked" value ='.$countIndex.'>
            	<button type = "submit">prev item page</button>
            </form>

             <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "itemRowClicked" value ="2">
            	<button type = "submit">test item details</button>
            </form>

            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "addFoundItemClicked" value ="">
            	<button type = "submit">Add an item</button>
            </form>



            <br>
            <form action = "./index.php" method = "POST">
            	<input type=hidden name = "backButtonClicked" value ="">
            	<button type = "submit">back</button>
            </form>
            <br>




         

            </body>
        </html>
            
        ';
        
        
        echo $html;
    }
}
?>