<?php
Class ItemDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        
        $itemToDisplay = $data['item'];
        $foundByUser = $data['user'];
        
        $username = $foundByUser->Username;
        $email = $foundByUser->Email;     
        $ID = $itemToDisplay->ItemID;
        $name = $itemToDisplay->Name;
        $desc = $itemToDisplay->Description;
        $category = $itemToDisplay->Category;
        $colour = $itemToDisplay->Colour;
        $date = $itemToDisplay->DateFound;
        $picsLocation = $itemToDisplay->PhotosFolderLoc;
        
        
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
                	<input type=hidden name = "tt" value ="">
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
}


?>