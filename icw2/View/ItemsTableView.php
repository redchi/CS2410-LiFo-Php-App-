<?php
Class ItemsTableView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Main item list VIEW!</h1>
               
					<br>
				<form action = "./index.php" method = "POST">
					<input type=hidden name = "backButtonClicked" value ="">
					<button type = "submit">back</button>
				<form>
				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>