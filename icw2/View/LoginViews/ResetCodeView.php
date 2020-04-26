<?php
Class ResetCodeView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>reset code enter VIEW!</h1>
            
                <br>
                <form action = "/UserInteraction" method = "POST">
                  <input type="text" name="resetCode" placeholder = "Reset Code"><br>
                  <input type="hidden" name = "resetCodeEntered" value ="">
                  <input type="submit" value="Submit">
                </form>
                <br>
            
            
            
            
				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>