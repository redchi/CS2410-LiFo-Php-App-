<?php
Class ResetPasswordView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Reset password VIEW!</h1>
            
                <br>
                <form action = "/UserInteraction" method = "POST">
                  <input type="password" name="password" placeholder = "password"><br>
                  <input type="password" name="password2" placeholder ="Confirm password"><br><br>
                  <input type="hidden" name = "newPasswordEntered" value ="">
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