<?php
Class LoginView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>LOGIN VIEW!</h1>

                <br>
                <form action = "'.URL."/UserInteraction".'" method = "POST">
                  <label for="fname">Username</label><br>
                  <input type="text" name="username"><br>
                  <label for="lname">Password</label><br>
                  <input type="password" name="password"><br><br>
                  <input type="hidden" name = "loginAttempt" value ="">
                  <input type="submit" value="Submit">
                </form> 
                <br>

		         <br>
				<form action = "'.URL."/forgot_password".'>
					<input type=hidden name = "forgotPasswordClicked" value ="">
					<button type = "submit">Forgot password</button>
				</form>
				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>