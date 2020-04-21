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
            
                <h1>LOGIN VIEW!</h1>
            
                <br>
                <form action = "./index.php" method = "POST">
                  <label for="fname">Username</label><br>
                  <input type="text" name="username"><br>
                  <label for="lname">Password</label><br>
                  <input type="password" name="password"><br><br>
                  <input type="hidden" name = "loginAttempt" value ="">
                  <input type="submit" value="Submit">
                </form>
                <br>
            
            
            
            
            
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