<?php
Class ForgotPassword extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>FORGOT PASSWORD VIEW!</h1>
            
                <br>
                <form action = "/UserInteraction" method = "POST">
                  <input type="text" name="email" placeholder =email required><br>
                  <input type="hidden" name = "emailSubmitForPasswordReset" value ="">
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