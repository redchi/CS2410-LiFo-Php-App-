<?php
Class RegisterView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>REGISTER VIEW!</h1>
					<br>
				<br>
                <form action = "./index.php" method = "POST">
                  <label for="fname">Username</label><br>
                  <input type="text" id="fname" name="username"><br>
                  <label for="lname">email</label><br>
                  <input type="text" id="lname" name="email"><br><br>
                  <label for="lname">Password</label><br>
                  <input type="password" id="lname" name="password"><br><br>
                  <label for="lname">Confirm Password</label><br>
                  <input type="password" id="lname" name="password2"><br><br>
                  <input type="hidden" name = "registerationAttempt" value ="">
                  <input type="submit" value="Submit">
                </form> 
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