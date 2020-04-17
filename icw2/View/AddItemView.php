<?php
Class AddItemView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1> ADD Item view!</h1>
			    <br>             
                </h3>
                    
                    
                    
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