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
            

                
            
            
                <form action = "./index.php" method = "POST">
                	<input type=hidden name = "backButtonClicked" value ="">
                	<button type = "submit">back</button>
                </form>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>