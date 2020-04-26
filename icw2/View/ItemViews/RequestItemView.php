<?php
Class RequestItemView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $item = $data["item"];
        $itemName = $item->Name;
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1> Request Item view!</h1>
			    <br><h3>
                 item name = '.$itemName.'
                </h3>
                <br>
            

                 <form action = "/UserInteraction" method = "POST">
                  <input type="text" name="request" placeholder = "request description" requred><br>      
                	    <input type=hidden name = "itemID" value ="'.$item->ItemID.'">
                        <input type=hidden name = "itemRequested" value ="">
                	<button type = "submit">submit</button>
                </form>
            

            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>